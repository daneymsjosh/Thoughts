<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register user
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate user
        $validated = $request->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        // Create user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard')->with('success', 'Account Created Successfuly!');
    }

    // Login user
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validate user
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Login user
        if (auth()->attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged In Successfuly!');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Invalid Credentials'
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged Out Successfuly!');
    }
}
