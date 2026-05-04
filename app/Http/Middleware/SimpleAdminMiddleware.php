<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Check if authenticated at all
        if (!auth()->check() && !session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Authentication required.');
        }

        // 2. Force allow for the main admin email
        if (auth()->check() && auth()->user()->email === 'admin@foodcart.com') {
            return $next($request);
        }

        // 3. Check role for others
        $role = session('user_role') ?? (auth()->check() ? auth()->user()->role : null);
        
        if (strtolower(trim($role)) !== 'admin') {
            return redirect()->route('home')->with('error', 'Access denied. Admins only.');
        }

        return $next($request);
    }
}