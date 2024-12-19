<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\InsuranceProvider;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $roles = Role::all(); // Fetch all roles
        $hospitals = Hospital::all(); // Fetch all hospitals
        $insuranceProviders = InsuranceProvider::all(); // Fetch all insurance providers

        return view('user.profile', compact('user', 'roles', 'hospitals', 'insuranceProviders'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'nullable|exists:roles,id', // Only allowed for superadmin
            'hospital_id' => 'nullable|exists:hospitals,id',
            'insurance_id' => 'nullable|exists:insurance_providers,id',
            'district' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:255',
            'cell' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        // Prepare the data for update
        $data = $request->only([
            'name',
            'email',
            'hospital_id',
            'insurance_id',
            'district',
            'sector',
            'cell',
            'province',
            'country',
        ]);

        // Conditionally update role_id if the user is a superadmin
        if ($user->role_id === 1 && $request->filled('role_id')) {
            $data['role_id'] = $request->role_id;
        }

        // Handle profile image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('profile_images', 'public');
        }

        // Log the data being updated for debugging
        Log::info('Updating user profile', ['user_id' => $user->id, 'data' => $data]);

        // Update the user profile
        $user->update($data);

        Toastr::success('Profile updated successfully.', 'Success');
        return redirect()->route('user.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            Toastr::error('Current password is incorrect.', 'Error');
            return back();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        Toastr::success('Password updated successfully.', 'Success');
        return back();
    }
}
