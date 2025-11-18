<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * Show reset password form
     */
    public function showResetForm(Request $request, $token = null)
    {
        // Verifikasi ada session reset_email
        if (!session('reset_email')) {
            return redirect()->route('password.request')
                ->with('error', 'Please request password reset first');
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle password reset
     */
    public function reset(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/'
            ],
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'password.regex' => 'Password must contain at least 1 number and 1 special character',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Ambil email dari session
        $email = session('reset_email');
        
        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Session expired. Please request password reset again');
        }

        // Update password
        $user = User::where('emailPengguna', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $user->passwordPengguna = $request->password;
        $user->save();

        // Clear session
        session()->forget('reset_email');

        return redirect()->route('password.success');
    }

    /**
     * Show success page
     */
    public function showSuccessPage()
    {
        return view('auth.success-updatedpass');
    }
}