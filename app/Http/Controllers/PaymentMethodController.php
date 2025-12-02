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
        $methods = PaymentMethod::all();
        // Jika Anda punya view admin untuk list payment method:
        // return view('admin.payment_methods.index', compact('methods'));
        
        // Untuk saat ini return json atau debug dulu
        return response()->json($methods);
    }

    /**
     * Tampilkan detail satu metode pembayaran
     */
    public function show($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return response()->json($method);
    }

    /**
     * (Opsional) Tambah Metode Pembayaran Baru
     * Berguna jika Anda membuat halaman Admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'methodName' => 'required|string|max:100',
            'detail' => 'nullable|string',
            'icon' => 'nullable|string' // misal path gambar
        ]);

        $newMethod = PaymentMethod::create([
            'methodName' => $request->methodName,
            'detail' => $request->detail,
            'icon' => $request->icon
        ]);

        return response()->json([
            'message' => 'Payment method created successfully',
            'data' => $newMethod
        ]);
    }
}