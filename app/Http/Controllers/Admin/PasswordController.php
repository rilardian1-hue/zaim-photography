<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.profile.password');
    }

    public function update(Request $request)
    {
        // Kunci rahasia akan mem-bypass current_password jika di-set dalam session
        $isSecretKeyReset = session('secret_key_reset', false);

        $rules = [
            'password' => ['required', 'confirmed', Password::defaults()],
        ];

        if (!$isSecretKeyReset) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $request->validate($rules);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        if ($isSecretKeyReset) {
            session()->forget('secret_key_reset');
        }

        return back()->with('status', 'password-updated')->with('success', 'Password berhasil diperbarui.');
    }
}
