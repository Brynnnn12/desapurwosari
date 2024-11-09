<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna belum login, arahkan ke halaman login
        if (!Auth::check()) {

            return redirect()->route('auth.login')->with('error', 'Anda harus login untuk mengakses halaman ini.');        }

        return $next($request);
    }
}
