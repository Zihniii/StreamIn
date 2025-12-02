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

        if (!$packageId) {
            return redirect()->back()->with('error', 'Package not selected');
        }

        $package = DB::table('package')->where('packageID', $packageId)->first();

        if (!$package) {
            return redirect()->back()->with('error', 'Package not found');
        }

        $paymentMethods = DB::table('paymentmethod')->orderBy('paymentMethodID')->get();
        $discounts = DB::table('discount')
            ->where('discountType', '!=', 'none')
            ->orderBy('discountID')
            ->get();

        return view('paymentdetails', [
            'package' => $package,
            'paymentMethods' => $paymentMethods,
            'discounts' => $discounts,
            'originalPrice' => $package->hargaPackage,
            'discountAmount' => 0
        ]);
    }

    /**
     * Proses halaman payment
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

        $package = DB::table('package')->where('packageID', $request->package_id)->first();
        $paymentMethod = DB::table('paymentmethod')->where('paymentMethodID', $request->payment_method_id)->first();

        $discount = null;
        if ($request->discount_id) {
            $discount = DB::table('discount')->where('discountID', $request->discount_id)->first();
        }

        // Simpan session payment
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
     * Confirm payment (Insert payment + subscription)
     */
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();
        $paymentData = session('payment_data');

        if (!$paymentData) {
            return redirect()->route('package.netflix')->with('error', 'Payment session expired');
        }

        // Cek timeout (10 menit)
        if (Carbon::parse($paymentData['created_at'])->diffInMinutes(now()) > 10) {
            session()->forget('payment_data');
            return redirect()->route('payment.details', ['package' => $paymentData['package_id']])
                ->with('error', 'Payment time expired. Please try again.');
        }

        try {
            DB::beginTransaction();

            /**
             * 1. Insert ke PAYMENT
             */
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

            /**
             * 2. Ambil account package yang AVAILABLE
             *    Lock supaya tidak direbut transaksi lain
             */
            $accountPackage = DB::table('accountpackage')
                ->where('status', 'available')
                ->lockForUpdate()
                ->first();

            if (!$accountPackage) {
                DB::rollBack();
                return redirect()->back()->with('error', 'No available account. Contact support.');
            }

            /**
             * 3. Ambil data package utk menentukan durasi
             */
            $package = DB::table('package')
                ->where('packageID', $paymentData['package_id'])
                ->first();

            $startDate = now();
            $endDate = $this->calculateEndDate($package);

            /**
             * 4. Insert ke user_subscriptions
             */
            $subscriptionId = DB::table('user_subscriptions')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['package_id'],
                'accountPackageID' => $accountPackage->accountPackageID,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => 'active'
            ]);

            /**
             * 5. Update accountPackage jadi USED
             */
            DB::table('accountpackage')
                ->where('accountPackageID', $accountPackage->accountPackageID)
                ->update([
                    'status' => 'used',
                    'updated_at' => now()
                ]);

            DB::commit();
            session()->forget('payment_data');

            return redirect()->route('payment.success', [
                'subscription' => $subscriptionId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    /**
     * Halaman success
     */
    public function showSuccess(Request $request)
    {
        $subscriptionId = $request->query('subscription');

        if (!$subscriptionId) {
            return redirect()->route('dashboard.index');
        }

        $subscription = DB::table('user_subscriptions')
            ->join('package', 'user_subscriptions.packageID', '=', 'package.packageID')
            ->join('accountpackage', 'user_subscriptions.accountPackageID', '=', 'accountpackage.accountPackageID')
            ->where('user_subscriptions.userSubscriptionID', $subscriptionId)
            ->select(
                'user_subscriptions.*',
                'package.*',
                'accountpackage.usernamePackage',
                'accountpackage.passwordPackage'
            )
            ->first();

        if (!$subscription) {
            return redirect()->route('dashboard.index');
        }

        return view('paymentsuccess', ['subscription' => $subscription]);
    }

    /**
     * Durasi berdasarkan packageType dan durasiPackage
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
                return $startDate->copy()->addDay();
        }
    }

    /**
     * AJAX timeout check
     */
    public function checkTimeout(Request $request)
    {
        $paymentData = session('payment_data');

        if (!$paymentData) {
            return response()->json(['expired' => true]);
        }

        $createdAt = Carbon::parse($paymentData['created_at']);
        $elapsedMinutes = $createdAt->diffInMinutes(now());

        if ($elapsedMinutes > 10) {
            session()->forget('payment_data');
            return response()->json(['expired' => true]);
        }

        return response()->json([
            'expired' => false,
            'remaining_seconds' => (10 * 60) - ($elapsedMinutes * 60)
        ]);
    }
}
