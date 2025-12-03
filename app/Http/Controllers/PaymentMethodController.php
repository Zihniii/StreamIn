<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Tampilkan semua metode pembayaran
     */
    public function index()
    {
        // Mengambil semua metode pembayaran dari database
        $methods = PaymentMethod::all();
        
        // Bisa dikembalikan sebagai JSON (untuk API)
        // atau View (untuk halaman Admin)
        return response()->json([
            'success' => true,
            'data' => $methods
        ]);
    }

    /**
     * Tampilkan detail satu metode pembayaran
     */
    public function show($id)
    {
        $method = PaymentMethod::find($id);

        if (!$method) {
            return response()->json(['success' => false, 'message' => 'Method not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $method]);
    }

    /**
     * (Opsional) Tambah Metode Pembayaran Baru
     * Berguna jika Anda membuat halaman Admin untuk menambah opsi pembayaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'methodName' => 'required|string|max:100',
            'detail' => 'nullable|string',
            'icon' => 'nullable|string' // misal path gambar/icon class
        ]);

        $newMethod = PaymentMethod::create([
            'methodName' => $request->methodName,
            'detail' => $request->detail,
            'icon' => $request->icon
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment method created successfully',
            'data' => $newMethod
        ]);
    }
}