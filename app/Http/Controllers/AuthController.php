<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('auth.login');
    }

    public function Storelogin(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (
            $data['email'] === 'admin@example.com' &&
            $data['password'] === '1234567'
        ) {
        $request->session()->put('is_login', true);
        $request->session()->put('user_email', $data['email']);

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil');
        }

        return back()
            ->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['is_login', 'user_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logout berhasil');
    }
}
