<?php

namespace App\Http\Controllers;

use App\Models\AccountPackage;
use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman payment details
     */
    public function showPaymentDetails(Request $request)
    {
        $packageID = $request->query('package');

        if (! $packageID) {
            return redirect()->back()->with('error', 'Package not selected');
        }

        // Tabel: 'Package'
        $package = DB::table('Package')
            ->where('packageID', $packageID)
            ->first();

        if (! $package) {
            return redirect()->back()->with('error', 'Package not found');
        }

        // Tabel: 'PaymentMethod'
        $paymentMethods = DB::table('PaymentMethod')
            ->orderBy('paymentMethodID', 'asc')
            ->get();

        $discounts = DB::table('discount')
            ->where('discountType', '!=', 'none')
            ->orderBy('discountID', 'asc')
            ->get();

        $originalPrice = $package->hargaPackage;
        $discountAmount = 0;

        return view('paymentdetails', [
            'package' => $package,
            'paymentMethods' => $paymentMethods,
            'discounts' => $discounts,
            'originalPrice' => $originalPrice,
            'discountAmount' => $discountAmount,
        ]);
    }

    // ---

    /**
     * Proses ke halaman payment
     */
    public function showPayment(Request $request)
    {
        // Validasi menggunakan camelCase
        $request->validate([
            'packageID' => 'required|integer',
            'paymentMethodID' => 'required|integer',
            'discountID' => 'nullable|integer',
            'referralCode' => 'nullable|string|max:50',
            'finalPrice' => 'required|numeric',
            'originalPrice' => 'required|numeric',
            'discountAmount' => 'nullable|numeric',
        ]);

        // Tabel: 'Package'
        $package = DB::table('Package')
            ->where('packageID', $request->packageID)
            ->first();

        // Tabel: 'PaymentMethod'
        $paymentMethod = DB::table('PaymentMethod')
            ->where('paymentMethodID', $request->paymentMethodID)
            ->first();

        $discount = null;
        if ($request->discountID) {
            $discount = DB::table('discount')
                ->where('discountID', $request->discountID)
                ->first();
        }

        // Session keys menggunakan camelCase
        session([
            'payment_data' => [
                'packageID' => $request->packageID,
                'paymentMethodID' => $request->paymentMethodID,
                'discountID' => $request->discountID,
                'referralCode' => $request->referralCode,
                'finalPrice' => $request->finalPrice,
                'originalPrice' => $request->originalPrice,
                'discountAmount' => $request->discountAmount ?? 0,
                'createdAt' => now(),
            ],
        ]);

        return view('payment', [
            'package' => $package,
            'paymentMethod' => $paymentMethod,
            'discount' => $discount,
            'originalPrice' => $request->originalPrice,
            'discountAmount' => $request->discountAmount ?? 0,
            'finalPrice' => $request->finalPrice,
        ]);
    }

    // ---

    /**
     * Proses confirm payment dan create order
     */
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();
        $paymentData = session('payment_data');

        if (! $paymentData) {
            return redirect()->route('package.netflix')->with('error', 'Payment session expired');
        }

        // Check if payment expired (10 minutes)
        $createdAt = Carbon::parse($paymentData['createdAt']);
        if ($createdAt->diffInMinutes(now()) > 10) {
            session()->forget('payment_data');

            return redirect()->route('payment.details', ['package' => $paymentData['packageID']])
                ->with('error', 'Payment time expired. Please try again.');
        }

        try {
            DB::beginTransaction();

            // 1. Insert payment record (Menggunakan snake_case untuk DB columns)
            $paymentId = DB::table('payment')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['packageID'],
                'paymentMethodID' => $paymentData['paymentMethodID'],
                'discountID' => $paymentData['discountID'],
                'amount' => $paymentData['finalPrice'],
                'adminFee' => 0,
                'paymentDate' => now(),
                'paymentStatus' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Get available account package (Tabel: 'AccountPackage')
            $accountPackage = DB::table('AccountPackage')
                ->where('status', 'active')
                ->where('validityPackage', 1)
                ->lockForUpdate()
                ->first();

            if (! $accountPackage) {
                DB::rollBack();

                return redirect()->back()->with('error', 'No available account. Please contact support.');
            }

            // 3. Get package details (Tabel: 'Package')
            $package = DB::table('Package')
                ->where('packageID', $paymentData['packageID'])
                ->first();

            // Calculate end date based on package type
            $startDate = now();
            $endDate = $this->calculateEndDate($package);

            // 4. Create user subscription (Tabel: 'usersubscription')
            $subscriptionId = DB::table('usersubscription')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['packageID'],
                'accountpackageID' => $accountPackage->accountpackageID,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 5. Update account package status (Tabel: 'AccountPackage')
            DB::table('AccountPackage')
                ->where('accountpackageID', $accountPackage->accountpackageID)
                ->update([
                    'validityPackage' => 0,
                    'updated_at' => now(),
                ]);

            DB::commit();

            session()->forget('payment_data');

            return redirect()->route('payment.success', [
                'subscription' => $subscriptionId,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment confirmation failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Payment failed: '.$e->getMessage());
        }
    }

    // ---
    // Function stubs needed for completeness
    private function calculateEndDate($package)
    {
        $startDate = now();
        switch ($package->packageType ?? 'Daily') {
            case 'Hourly':
                return $startDate->copy()->addHours($package->durasiPackage ?? 1);
            case 'Daily':
                return $startDate->copy()->addDays($package->durasiPackage ?? 1);
            case 'Monthly':
                return $startDate->copy()->addMonths($package->durasiPackage ?? 1);
            default:
                return $startDate->copy()->addDays(1);
        }
    }

    private function generateUsername()
    {
        return 'user_'.strtolower(Str::random(6));
    }

    private function generatePassword()
    {
        return Str::random(12);
    }

    public function showSuccess(Request $request)
    {
        $subscriptionId = $request->query('subscription');

        if (! $subscriptionId) {
            return redirect()->route('dashboard');
        }

        $subscription = DB::table('usersubscription')
            ->join('package', 'usersubscription.packageID', '=', 'package.packageID')
            ->join('accountpackage', 'usersubscription.accountpackageID', '=', 'accountpackage.accountpackageID')
            ->where('usersubscription.userSubscriptionID', $subscriptionId)
            ->select('usersubscription.*', 'package.*', 'accountpackage.usernamePackage', 'accountpackage.passwordPackage')
            ->first();

        if (! $subscription) {
            return redirect()->route('dashboard');
        }

        return view('paymentsuccess', [
            'subscription' => $subscription,
        ]);
    }

    public function checkTimeout(Request $request)
    {
        $paymentData = session('payment_data');

        if (! $paymentData) {
            return response()->json(['expired' => true]);
        }

        $createdAt = Carbon::parse($paymentData['createdAt']);
        $minutesElapsed = $createdAt->diffInMinutes(now());

        if ($minutesElapsed > 10) {
            session()->forget('payment_data');

            return response()->json(['expired' => true]);
        }

        return response()->json([
            'expired' => false,
            'remaining_seconds' => (10 * 60) - ($minutesElapsed * 60),
        ]);
    }
}
