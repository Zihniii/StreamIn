<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
 /*=============================================
    Coded by: Bagas Rafi Dewantara
    NRP: 5026231091
    =============================================  */
class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:User,emailPengguna',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.exists' => 'Email not found in our records',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // TODO: Send email dengan reset link
        // Untuk sekarang, langsung redirect ke reset password page
        
        // Simpan email ke session untuk verifikasi di reset password
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset', ['token' => 'token'])
            ->with('status', 'Password reset link has been sent to your email!');
    }
}