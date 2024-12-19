<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            Log::warning('Unauthorized access attempt: user not logged in.');
            Toastr::error('Please log in to access this page.', 'Access Denied');
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role->name ?? 'No Role';

        if (in_array($userRole, $roles)) {
            Log::info('Access granted', ['user_id' => Auth::id(), 'role' => $userRole]);
            return $next($request);
        }

        Log::warning('Access denied', [
            'user_id' => Auth::id(),
            'role' => $userRole,
            'required_roles' => $roles,
            'current_route' => $request->route()->getName(),
            'current_url' => $request->url(),
        ]);

        Toastr::error('You do not have permission to access this page.', 'Access Denied');
        return redirect()->route('login'); // Redirecting to a more user-appropriate route may be better, such as a dashboard.
    }
}
