<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak valid.',
        ])->onlyInput('email');
    }

    public function loginWithSecret(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'secret_key' => ['required'],
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user || empty($user->secret_key) || !hash_equals((string)$user->secret_key, (string)$request->secret_key)) {
            return back()->withErrors([
                'email' => 'Email atau Kunci Rahasia tidak valid.',
            ])->onlyInput('email');
        }

        // Check if used within 24 hours
        if ($user->secret_key_used_at && now()->diffInHours($user->secret_key_used_at) < 24) {
            return back()->withErrors([
                'email' => 'Kunci Rahasia ini sudah digunakan dalam 24 jam terakhir. Silakan coba lagi nanti.',
            ])->onlyInput('email');
        }

        // Valid, log them in
        Auth::login($user);
        $request->session()->regenerate();

        // Update used time
        $user->update(['secret_key_used_at' => now()]);

        // Set session flag so they can change password without old password
        session(['secret_key_reset' => true]);

        return redirect()->route('admin.password.edit')->with('success', 'Berhasil masuk dengan Kunci Rahasia. Silakan ubah password Anda sekarang.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
