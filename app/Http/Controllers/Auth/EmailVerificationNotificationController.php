<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    /**
     * Send a new email verification notification for unauthenticated users.
     */
    public function resendGuest(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $key = 'resend-verify:' . $request->ip() . ':' . $request->email;

        // Cek cooldown 120 detik
        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->route('login')
                ->with('error', "Terlalu banyak permintaan. Silakan tunggu {$seconds} detik sebelum mengirim ulang otomatis.")
                ->with('unverified_email', $request->email);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            RateLimiter::hit($key, 120); // pass 120 directly as integer representation of seconds in modern laravel/cache, or if outdated, it expects seconds usually. Actually hit accepts seconds.
            
            try {
                $user->sendEmailVerificationNotification();
                return redirect()->route('login')
                    ->with('success', 'Email verifikasi berhasil dikirim ulang ke kotak masuk/spam Anda!')
                    ->with('unverified_email', $user->email);
            } catch (\Exception $e) {
                return redirect()->route('login')
                    ->with('error', 'Gagal mengirim email karena SMTP Server Error: ' . $e->getMessage())
                    ->with('unverified_email', $user->email);
            }
        }

        return redirect()->route('login')
            ->with('error', 'Email tidak ditemukan atau sudah diverifikasi.');
    }
}
