<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }


        // Memeriksa apakah pengguna sudah login dan memiliki peran 'admin'
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman utama

        return redirect('error.404')->with('error', 'You do not have permission to access this page.');
    }
}
