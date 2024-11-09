<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Solahkan Login Terlebih Dahulu!');
        }

        // Memeriksa apakah pengguna memiliki izin yang diberikan
        if (!Auth::user()->can($permission)) {
            return redirect()->route('error.404')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }

}
