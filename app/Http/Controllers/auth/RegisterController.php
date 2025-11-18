<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->route('homepage');
        }
        
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:User,emailPengguna',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/'
            ],
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'password.regex' => 'Password must contain at least 1 number and 1 special character',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('name', 'email'));
        }

        // Create user
        $user = User::create([
            'usernamePengguna' => $request->name,
            'emailPengguna' => $request->email,
            'passwordPengguna' => $request->password,
            'fotoProfil' => null, // Default null
        ]);

        // Auto login after registration
        Auth::login($user);

        return redirect()->route('homepage')
            ->with('success', 'Registration successful! Welcome to Stream.in');
    }
}

//         return redirect()->route('home')
//             ->with('success', 'Logged out successfully.');
//     }
// }