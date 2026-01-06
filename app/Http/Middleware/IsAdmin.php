<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan apakah rolenya adalah admin
        // Sesuaikan 'admin' dengan nama role yang kamu pakai di database
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika bukan admin, lempar balik ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Kamu bukan Admin.');
    }
}