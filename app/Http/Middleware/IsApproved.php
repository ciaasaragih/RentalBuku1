<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user sudah login, rolenya penyewa, tapi belum di-approve
        if (Auth::check() && Auth::user()->role === 'penyewa' && !Auth::user()->is_approved) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Akun Anda masih dalam status menunggu approval admin.');
        }

        return $next($request);
    }
}