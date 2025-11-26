<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $selectedDiscount = null;

        return view('paymentdetails', [
            'package' => $package,
            'paymentMethods' => $paymentMethods,
            'discounts' => $discounts,
            'originalPrice' => $originalPrice,
            'discountAmount' => $discountAmount
        ]);
    }

    /**
     * Proses checkout dan create order
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'discount_id' => 'nullable|integer',
            'referral_code' => 'nullable|string|max:50',
            'final_price' => 'required|numeric'
        ]);

        // Di sini Anda bisa menambahkan logic untuk:
        // 1. Create order di database
        // 2. Process payment
        // 3. Send confirmation email
        // 4. Redirect ke success page

        // Contoh sederhana:
        try {
            // Insert ke table orders (sesuaikan dengan struktur table Anda)
            $orderId = DB::table('orders')->insertGetId([
                'packageID' => $request->package_id,
                'paymentMethodID' => $request->payment_method_id,
                'discountID' => $request->discount_id,
                'referralCode' => $request->referral_code,
                'totalPrice' => $request->final_price,
                'orderStatus' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('payment.success', ['order' => $orderId])
                ->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to process checkout: ' . $e->getMessage());
        }
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount(Request $request)
    {
        $originalPrice = $request->original_price;
        $discountId = $request->discount_id;

        if (!$discountId) {
            return response()->json([
                'discount_amount' => 0,
                'final_price' => $originalPrice
            ]);
        }

        $discount = DB::table('discount')
            ->where('discountID', $discountId)
            ->first();

        if (!$discount) {
            return response()->json([
                'discount_amount' => 0,
                'final_price' => $originalPrice
            ]);
        }

        $discountAmount = 0;

        if ($discount->discountType === 'percentage') {
            $discountAmount = ($originalPrice * $discount->discountValue) / 100;
        } elseif ($discount->discountType === 'cashback') {
            $discountAmount = $discount->discountValue * 1000; // Cashback dalam ribuan
        }

        $finalPrice = $originalPrice - $discountAmount;

        return response()->json([
            'discount_amount' => $discountAmount,
            'final_price' => max(0, $finalPrice)
        ]);
    }
}