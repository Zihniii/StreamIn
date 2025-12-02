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
use Illuminate\Database\QueryException; 

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman detail pembayaran (Langkah 1)
     */
    public function showPaymentDetails(Request $request)
    {
        $packageID = $request->query('package');
        if (! $packageID) return redirect()->back()->with('error', 'Package not selected');
        
        $package = DB::table('Package')->where('packageID', $packageID)->first();
        if (! $package) return redirect()->back()->with('error', 'Package not found');
        
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

        if (! $paymentData) {
            return redirect()->route('package.netflix')->with('error', 'Sesi pembayaran habis/hilang.');
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
                'discountID' => $paymentData['discountID'],
                'amount' => $paymentData['finalPrice'],
                'adminFee' => 0,
                'paymentDate' => now(),
                'paymentStatus' => 'paid', 
            ]);

            // -----------------------------------------------------------
            // 2. Cari Akun (Service Based Matching)
            // -----------------------------------------------------------
            // Ambil info paket yang dibeli user
            $purchasedPackage = DB::table('package')->where('packageID', $paymentData['packageID'])->first();
            $targetService = $purchasedPackage->serviceName; // Contoh: "Netflix"

            // Cari akun yang terhubung ke paket dengan layanan yang SAMA ("Netflix")
            // Join ini sekarang BERHASIL karena kolom packageID sudah Anda buat.
            $accountPackage = DB::table('accountpackage')
                ->join('package', 'accountpackage.packageID', '=', 'package.packageID') 
                ->where('package.serviceName', $targetService) 
                ->where(function($query) {
                    $query->where('accountpackage.status', 'active')
                          ->orWhere('accountpackage.status', 'Active');
                })
                ->select('accountpackage.*') // Ambil data akun saja
                ->inRandomOrder() // Acak (Shared Account)
                ->first();

            if (! $accountPackage) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Stok akun untuk layanan '.$targetService.' sedang kosong. Hubungi Admin.');
            }

            // -----------------------------------------------------------
            // 3. Hitung Tanggal (Start & End)
            // -----------------------------------------------------------
            $startDate = now();
            $endDate = $this->calculateEndDate($purchasedPackage);

            // -----------------------------------------------------------
            // 4. Simpan Langganan (User Subscription)
            // -----------------------------------------------------------
            // Ambil ID akun dengan aman (antisipasi beda huruf besar/kecil)
            $accPkgId = $accountPackage->accountPackageID ?? $accountPackage->accountpackageID;

            $subscriptionId = DB::table('user_subscriptions')->insertGetId([
                'userID' => $user->userID,               
                'packageID' => $paymentData['packageID'], 
                'accountPackageID' => $accPkgId,          
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => 'active'
            ]);

            DB::commit();
            session()->forget('payment_data');

            return redirect()->route('payment.success', [
                'subscription' => $subscriptionId,
            ]);

        } catch (QueryException $e) {
            DB::rollBack();
            // Pesan error teknis untuk developer
            return redirect()->back()->with('error', 'Database Error: '.$e->getMessage());

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: '.$e->getMessage());
        }
    }

    /**
     * Halaman Sukses
     */
    public function showSuccess(Request $request)
    {
        $subscriptionId = $request->query('subscription');
        if (! $subscriptionId) return redirect()->route('dashboard');

        // Join tabel untuk menampilkan detail di struk
        $subscription = DB::table('user_subscriptions')
            ->join('package', 'user_subscriptions.packageID', '=', 'package.packageID')
            ->join('accountpackage', 'user_subscriptions.accountPackageID', '=', 'accountpackage.accountPackageID')
            ->where('user_subscriptions.userSubscriptionID', $subscriptionId)
            ->select('user_subscriptions.*', 'package.*', 'accountpackage.usernamePackage', 'accountpackage.passwordPackage')
            ->first();

        // Fallback jika join gagal karena nama kolom beda case
        if (! $subscription) {
             $subscription = DB::table('user_subscriptions')
                ->join('package', 'user_subscriptions.packageID', '=', 'package.packageID')
                ->join('accountpackage', 'user_subscriptions.accountpackageID', '=', 'accountpackage.accountPackageID') 
                ->where('user_subscriptions.userSubscriptionID', $subscriptionId)
                ->select('user_subscriptions.*', 'package.*', 'accountpackage.usernamePackage', 'accountpackage.passwordPackage')
                ->first();
        }

        if (! $subscription) {
            return redirect()->route('dashboard')->with('error', 'Data tidak ditemukan');
        }

        return view('paymentsuccess', ['subscription' => $subscription]);
    }

    public function checkTimeout(Request $request)
    {
        $paymentData = session('payment_data');
        if (! $paymentData) return response()->json(['expired' => true]);

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
        } elseif (str_contains($type, 'day') || str_contains($type, 'hari')) {
            return $now->addDays($duration);
        } elseif (str_contains($type, 'year') || str_contains($type, 'tahun')) {
            return $now->addYears($duration);
        }
        return $now->addMonths($duration);
    }
}