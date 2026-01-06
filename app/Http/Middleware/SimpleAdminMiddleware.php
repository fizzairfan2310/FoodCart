<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id') || session('user_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Access denied. Admins only.');
        }

        return $next($request);
    }
}