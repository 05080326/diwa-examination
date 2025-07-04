<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'fullname' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'name' => $request->fullname,
            'email' => $request->username . '@example.com',
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/login')->with('success', 'Registration successful');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}