<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role->name, $roles)) {
            return $next($request);
        }
        Toastr::error('You do not have permission to access this page.', 'Access Denied');
        return redirect()->route('login');
    }
}
