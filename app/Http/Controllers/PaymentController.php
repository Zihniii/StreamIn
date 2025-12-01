<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman payment details
     */
    public function showPaymentDetails(Request $request)
    {
        $packageId = $request->query('package');
        
        // Validasi package ID
        if (!$packageId) {
            return redirect()->back()->with('error', 'Package not selected');
        }

        // Ambil data package dari database
        $package = DB::table('package')
            ->where('packageID', $packageId)
            ->first();

        if (!$package) {
            return redirect()->back()->with('error', 'Package not found');
        }

        // Ambil semua payment methods
        $paymentMethods = DB::table('paymentmethod')
            ->orderBy('paymentMethodID', 'asc')
            ->get();

        // Ambil semua discount yang aktif
        $discounts = DB::table('discount')
            ->where('discountType', '!=', 'none')
            ->orderBy('discountID', 'asc')
            ->get();

        // Hitung harga setelah diskon
        $originalPrice = $package->hargaPackage;
        $discountAmount = 0;

        return view('paymentdetails', [
            'package' => $package,
            'paymentMethods' => $paymentMethods,
            'discounts' => $discounts,
            'originalPrice' => $originalPrice,
            'discountAmount' => $discountAmount
        ]);
    }

    /**
     * Proses ke halaman payment
     */
    public function showPayment(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'discount_id' => 'nullable|integer',
            'referral_code' => 'nullable|string|max:50',
            'final_price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'discount_amount' => 'nullable|numeric'
        ]);

        // Ambil data package
        $package = DB::table('package')
            ->where('packageID', $request->package_id)
            ->first();

        // Ambil data payment method
        $paymentMethod = DB::table('paymentmethod')
            ->where('paymentMethodID', $request->payment_method_id)
            ->first();

        // Ambil discount jika ada
        $discount = null;
        if ($request->discount_id) {
            $discount = DB::table('discount')
                ->where('discountID', $request->discount_id)
                ->first();
        }

        // Simpan data ke session untuk digunakan di confirm payment
        session([
            'payment_data' => [
                'package_id' => $request->package_id,
                'payment_method_id' => $request->payment_method_id,
                'discount_id' => $request->discount_id,
                'referral_code' => $request->referral_code,
                'final_price' => $request->final_price,
                'original_price' => $request->original_price,
                'discount_amount' => $request->discount_amount ?? 0,
                'created_at' => now()
            ]
        ]);

        return view('payment', [
            'package' => $package,
            'paymentMethod' => $paymentMethod,
            'discount' => $discount,
            'originalPrice' => $request->original_price,
            'discountAmount' => $request->discount_amount ?? 0,
            'finalPrice' => $request->final_price
        ]);
    }

    /**
     * Proses confirm payment dan create order
     */
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();
        $paymentData = session('payment_data');

        if (!$paymentData) {
            return redirect()->route('package.netflix')->with('error', 'Payment session expired');
        }

        // Check if payment expired (10 minutes)
        $createdAt = Carbon::parse($paymentData['created_at']);
        if ($createdAt->diffInMinutes(now()) > 10) {
            session()->forget('payment_data');
            return redirect()->route('payment.details', ['package' => $paymentData['package_id']])
                ->with('error', 'Payment time expired. Please try again.');
        }

        try {
            DB::beginTransaction();

            // 1. Insert payment record
            $paymentId = DB::table('payment')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['package_id'],
                'paymentMethodID' => $paymentData['payment_method_id'],
                'discountID' => $paymentData['discount_id'],
                'amount' => $paymentData['final_price'],
                'adminFee' => 0,
                'paymentDate' => now(),
                'paymentStatus' => 'completed',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 2. Get available account package
            $accountPackage = DB::table('accountpackage')
                ->where('status', 'active')
                ->where('validityPackage', 1)
                ->lockForUpdate()
                ->first();

            if (!$accountPackage) {
                DB::rollBack();
                return redirect()->back()->with('error', 'No available account. Please contact support.');
            }

            // 3. Get package details untuk calculate end date
            $package = DB::table('package')
                ->where('packageID', $paymentData['package_id'])
                ->first();

            // Calculate end date based on package type
            $startDate = now();
            $endDate = $this->calculateEndDate($package);

            // 4. Create user subscription
            $subscriptionId = DB::table('usersubscription')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['package_id'],
                'accountPackageID' => $accountPackage->accountPackageID,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 5. Update account package status
            DB::table('accountpackage')
                ->where('accountPackageID', $accountPackage->accountPackageID)
                ->update([
                    'validityPackage' => 0,
                    'updated_at' => now()
                ]);

            DB::commit();

            // Clear session
            session()->forget('payment_data');

            // Redirect to success page
            return redirect()->route('payment.success', [
                'subscription' => $subscriptionId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    /**
     * Show payment success page
     */
    public function showSuccess(Request $request)
    {
        $subscriptionId = $request->query('subscription');
        
        if (!$subscriptionId) {
            return redirect()->route('dashboard.index');
        }

        $subscription = DB::table('usersubscription')
            ->join('package', 'usersubscription.packageID', '=', 'package.packageID')
            ->join('accountpackage', 'usersubscription.accountPackageID', '=', 'accountpackage.accountPackageID')
            ->where('usersubscription.userSubscriptionID', $subscriptionId)
            ->select('usersubscription.*', 'package.*', 'accountpackage.usernamePackage', 'accountpackage.passwordPackage')
            ->first();

        if (!$subscription) {
            return redirect()->route('dashboard.index');
        }

        return view('paymentsuccess', [
            'subscription' => $subscription
        ]);
    }

    /**
     * Calculate end date based on package type
     */
    private function calculateEndDate($package)
    {
        $startDate = now();
        
        switch ($package->packageType) {
            case 'Hourly':
                return $startDate->copy()->addHours($package->durasiPackage);
            case 'Daily':
                return $startDate->copy()->addDays($package->durasiPackage);
            case 'Monthly':
                return $startDate->copy()->addMonths($package->durasiPackage);
            default:
                return $startDate->copy()->addDays(1);
        }
    }

    /**
     * Check payment timeout (AJAX)
     */
    public function checkTimeout(Request $request)
    {
        $paymentData = session('payment_data');

        if (!$paymentData) {
            return response()->json(['expired' => true]);
        }

        $createdAt = Carbon::parse($paymentData['created_at']);
        $minutesElapsed = $createdAt->diffInMinutes(now());

        if ($minutesElapsed > 10) {
            session()->forget('payment_data');
            return response()->json(['expired' => true]);
        }

        return response()->json([
            'expired' => false,
            'remaining_seconds' => (10 * 60) - ($minutesElapsed * 60)
        ]);
    }
}