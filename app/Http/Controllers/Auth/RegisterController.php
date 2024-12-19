<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Debugging: Log validation success
        logger()->info('User registration validation passed', ['email' => $request->email]);

        // Assign the 'Patient' role by default upon registration
        $patientRole = Role::firstOrCreate(['name' => 'Patient']);

        // Debugging: Log role assignment
        logger()->info('Assigned role', ['role' => $patientRole->name]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $patientRole->id, // Assign Patient role
        ]);

        // Debugging: Log user creation
        logger()->info('User created successfully', ['email' => $request->email]);

        Toastr::success('Registration successful! Please log in.', 'Success');
        return redirect()->route('login');
    }
}

