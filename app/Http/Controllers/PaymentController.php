<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman detail pembayaran (Langkah 1)
     */
    public function showPaymentDetails(Request $request)
    {
        $packageID = $request->query('package');
        if (! $packageID) {
            return redirect()->back()->with('error', 'Package not selected');
        }

        $package = DB::table('Package')->where('packageID', $packageID)->first();
        if (! $package) {
            return redirect()->back()->with('error', 'Package not found');
        }

        $paymentMethods = DB::table('PaymentMethod')->orderBy('paymentMethodID', 'asc')->get();
        $discounts = DB::table('discount')->where('discountType', '!=', 'none')->get();

        return view('paymentdetails', [
            'package' => $package,
            'paymentMethods' => $paymentMethods,
            'discounts' => $discounts,
            'originalPrice' => $package->hargaPackage,
            'discountAmount' => 0,
        ]);
    }

    /**
     * Proses halaman pembayaran (Langkah 2 - Preview & Save Session)
     */
    public function showPayment(Request $request)
    {
        $request->validate([
            'packageID' => 'required|integer',
            'paymentMethodID' => 'required|integer',
            'discountID' => 'nullable|integer',
            'finalPrice' => 'required|numeric',
            'originalPrice' => 'required|numeric',
        ]);

        $package = DB::table('Package')->where('packageID', $request->packageID)->first();
        $paymentMethod = DB::table('PaymentMethod')->where('paymentMethodID', $request->paymentMethodID)->first();

        $discount = null;
        if ($request->discountID) {
            $discount = DB::table('discount')->where('discountID', $request->discountID)->first();
        }

        session([
            'payment_data' => [
                'packageID' => $request->packageID,
                'paymentMethodID' => $request->paymentMethodID,
                'discountID' => $request->discountID,
                'referralCode' => $request->referralCode ?? null,
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

    /**
     * Konfirmasi Pembayaran (Langkah 3 - Eksekusi Final)
     */
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();
        $paymentData = session('payment_data');

        if (! $paymentData || ! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi pembayaran habis atau user tidak login.',
            ], 401);
        }

        try {
            DB::beginTransaction();

            // -----------------------------------------------------------
            // 1. Simpan Uang Masuk (Payment Table)
            // -----------------------------------------------------------
            $paymentId = DB::table('payment')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['packageID'],
                'paymentMethodID' => $paymentData['paymentMethodID'],
                'discountID' => $paymentData['discountID'] ?? null,
                'amount' => $paymentData['finalPrice'],
                'adminFee' => 0,
                'paymentDate' => now(),
                'paymentStatus' => 'paid',
            ]);

            // -----------------------------------------------------------
            // 2. Dapatkan Info Paket yang Dibeli
            // -----------------------------------------------------------
            $purchasedPackage = DB::table('package')->where('packageID', $paymentData['packageID'])->first();

            if (! $purchasedPackage) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'Paket tidak ditemukan.',
                ], 404);
            }

            // -----------------------------------------------------------
            // 3. Hitung Tanggal (Start & End)
            // -----------------------------------------------------------
            $startDate = now();
            $endDate = $this->calculateEndDate($purchasedPackage);

            // -----------------------------------------------------------
            // 4. BUAT AKUN BARU (Dynamic Generation)
            // -----------------------------------------------------------
            $serviceName = $purchasedPackage->serviceName;
            $username = $this->generateAccountUsername($serviceName);
            $password = $this->generateAccountPassword();

            $accountPackageId = DB::table('accountpackage')->insertGetId([
                'packageID' => $purchasedPackage->packageID, // Use actual package ID
                'usernamePackage' => $username,
                'passwordPackage' => $password,
                'validityPackage' => 1, // 1 = valid/active
                'status' => 'active',
                // Note: We're NOT adding new columns, using existing structure
            ]);

            // -----------------------------------------------------------
            // 5. Simpan Langganan (User Subscription)
            // -----------------------------------------------------------
            $subscriptionId = DB::table('user_subscriptions')->insertGetId([
                'userID' => $user->userID,
                'packageID' => $paymentData['packageID'],
                'accountPackageID' => $accountPackageId, // Use NEWLY created account
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => 'active',
            ]);

            DB::commit();

            // Clear session
            session()->forget('payment_data');

            return response()->json([
                'success' => true,
                'subscription_id' => $subscriptionId,
                'redirect_url' => route('payment.success', ['subscription' => $subscriptionId]),
            ]);

        } catch (QueryException $e) {
            DB::rollBack();

            \Log::error('Payment DB Error: '.$e->getMessage(), [
                'user_id' => $user->userID ?? null,
                'payment_data' => $paymentData,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Database Error: '.$e->getMessage(),
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Payment System Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate unique username based on service
     */
    private function generateAccountUsername($serviceName)
    {
        // Clean service name (remove spaces, special chars)
        $cleanService = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $serviceName));

        // Generate random suffix
        $random = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
        $timestamp = time() % 10000; // Last 4 digits of timestamp

        return $cleanService.'_'.$random.$timestamp;
    }

    /**
     * Generate strong password
     */
    private function generateAccountPassword()
    {
        // 10-character password with letters and numbers
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        return substr(str_shuffle($chars), 0, 10);
    }

    /**
     * Halaman Sukses
     */
    public function showSuccess($subscription)
    {
        $subscriptionId = $subscription;

        $subscription = DB::table('user_subscriptions')
            ->join('package', 'user_subscriptions.packageID', '=', 'package.packageID')
            ->join('accountpackage', 'user_subscriptions.accountPackageID', '=', 'accountpackage.accountPackageID')
            ->where('user_subscriptions.userSubscriptionID', $subscriptionId)
            ->where('user_subscriptions.userID', Auth::user()->userID)
            ->select(
                'user_subscriptions.*',
                'package.*',
                'accountpackage.usernamePackage',
                'accountpackage.passwordPackage'
            )
            ->first();

        if (! $subscription) {
            return redirect()->route('dashboard')->with('error', 'Data tidak ditemukan');
        }

        return view('paymentsuccess', compact('subscription'));
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

    private function calculateEndDate($package)
    {
        $now = Carbon::now();
        $type = strtolower($package->packageType ?? '');
        $duration = (int) ($package->durasiPackage ?? 1);

        if (str_contains($type, 'hour') || str_contains($type, 'jam')) {
            return $now->addHours($duration);
        } elseif (str_contains($type, 'day') || str_contains($type, 'hari') || str_contains($type, 'daily')) {
            return $now->addDays($duration);
        } elseif (str_contains($type, 'month') || str_contains($type, 'bulan') || str_contains($type, 'monthly')) {
            return $now->addMonths($duration);  // FIXED: changed addYears to addMonths
        }

    }
}
