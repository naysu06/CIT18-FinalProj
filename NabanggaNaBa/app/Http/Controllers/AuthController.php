<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function index()
    {
        return view('login');
    }

    // Show registration form
    public function create()
    {
        return view('register');
    }

    // Handle registration
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,user', // validate role input
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role !== $request->role) {
                Auth::logout();
                return back()->withErrors([
                    'role' => 'Invalid role selected for this account.',
                ]);
            }
    
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Login successful!');
            }
            
        }
    
        return back()->withErrors(['username' => 'Invalid username or password.']);
    }    

    // Handle logout
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
