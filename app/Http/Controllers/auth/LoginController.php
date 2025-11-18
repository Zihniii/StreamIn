<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->route('homepage');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        // Cari user berdasarkan email
        $user = User::where('emailPengguna', $request->email)->first();

        // Check credentials
        if ($user && $request->password == $user->passwordPengguna) {
            // Login user
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended(route('homepage'))
                ->with('success', 'Login successful!');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Invalid Email or Password',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')
            ->with('success', 'Logged out successfully!');
    }
}