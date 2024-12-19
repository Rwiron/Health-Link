<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Debugging: Log successful login
            logger()->info('User logged in successfully', ['email' => $user->email, 'role' => $user->role->name]);

            // Check the user role and redirect accordingly
            switch ($user->role->name) {
                case 'SuperAdmin':
                    Toastr::success('Welcome, SuperAdmin!', 'Success');
                    return redirect()->route('superadmin.dashboard');

                case 'Admin':
                    Toastr::success('Welcome, Admin!', 'Success');
                    return redirect()->route('admin.dashboard');

                case 'Doctor':
                    Toastr::success('Welcome, Doctor!', 'Success');
                    return redirect()->route('doctor.dashboard');

                case 'Patient':
                    Toastr::success('Welcome, Patient!', 'Success');
                    return redirect()->route('patient.dashboard');

                default:
                    Auth::logout();
                    logger()->error('Unrecognized role during login', ['email' => $user->email, 'role' => $user->role->name]);
                    Toastr::error('Your account role is not recognized. Please contact support.', 'Login Failed');
                    return redirect()->route('login');
            }
        }

        // Debugging: Log failed login attempt
        logger()->warning('Invalid login attempt', ['email' => $request->email]);

        // Toastr error message for invalid credentials
        Toastr::error('Invalid email or password. Please try again.', 'Login Failed');
        return back()->withInput($request->only('email'));
    }
    

    public function logout()
    {
        $user = Auth::user();

        // Debugging: Log logout event
        logger()->info('User logged out', ['email' => $user->email, 'role' => $user->role->name]);

        Auth::logout();
        Toastr::success('Logout successful!', 'Success');
        return redirect()->route('login');
    }
}
