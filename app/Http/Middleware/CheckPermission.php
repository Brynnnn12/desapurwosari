<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        // Cek apakah pengguna terautentikasi dan memiliki permission


        return $next($request);
    }
}
