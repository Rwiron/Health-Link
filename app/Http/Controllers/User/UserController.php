<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\InsuranceProvider;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        Log::info('Fetching users, roles, hospitals, and insurance providers');
        $users = User::with('role', 'hospital')->get();
        $roles = Role::all();
        $hospitals = Hospital::all();
        $insuranceProviders = InsuranceProvider::all();
        return view('user.index', compact('users', 'roles', 'hospitals', 'insuranceProviders'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Storing new user', ['request' => $request->all()]);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role_id' => 'required|exists:roles,id',
                'insurance_id' => 'nullable|exists:insurance_providers,id',
                'hospital_id' => 'nullable|exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'district' => 'nullable|string|max:255',
                'sector' => 'nullable|string|max:255',
                'cell' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
            ]);

            $data = $request->except(['password_confirmation', 'image']);
            $data['password'] = Hash::make($request->password);

            if ($request->hasFile('image')) {
                Log::info('Uploading user profile image');
                $file = $request->file('image');
                $path = $file->store('profile_images', 'public');
                $data['image'] = $path;
            }

            User::create($data);

            Toastr::success('User added successfully.', 'Success');
            Log::info('User added successfully');
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            Log::error('Error adding user: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while adding the user.', 'Error');
            return redirect()->route('user.index');
        }
    }

   
    public function update(Request $request, $id)
    {
        try {
            Log::info('Updating user', ['id' => $id, 'request' => $request->all()]);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
                'role_id' => 'required|exists:roles,id',
                'insurance_id' => 'nullable|exists:insurance_providers,id',
                'hospital_id' => 'nullable|exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'district' => 'nullable|string|max:255',
                'sector' => 'nullable|string|max:255',
                'cell' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
            ]);

            $user = User::findOrFail($id);
            $data = $request->except(['password_confirmation', 'image']);

            if ($request->filled('password')) {
                Log::info('Updating user password');
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                Log::info('Uploading new user profile image', ['user_id' => $id]);
                $file = $request->file('image');
                $path = $file->store('profile_images', 'public');
                $data['image'] = $path;

                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Log::info('Deleting old profile image', ['path' => $user->image]);
                    Storage::disk('public')->delete($user->image);
                }
            }

            // Debug insurance_id field specifically
            if ($request->has('insurance_id')) {
                $providedInsuranceId = $request->insurance_id;
                Log::info('Updating user insurance', ['provided_insurance_id' => $providedInsuranceId]);

                if (InsuranceProvider::find($providedInsuranceId)) {
                    Log::info('Valid insurance_id provided', ['insurance_id' => $providedInsuranceId]);
                    $data['insurance_id'] = $providedInsuranceId;
                } else {
                    Log::warning('Invalid insurance_id provided', ['insurance_id' => $providedInsuranceId]);
                }
            } else {
                Log::info('No insurance_id provided in the request');
            }

            $user->update($data);

            Toastr::success('User updated successfully.', 'Success');
            Log::info('User updated successfully', ['user_id' => $id, 'updated_data' => $data]);
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while updating the user.', 'Error');
            return redirect()->route('user.index');
        }
    }


    public function destroy($id)
    {
        try {
            Log::info('Deleting user', ['id' => $id]);
            $user = User::findOrFail($id);

            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Log::info('Deleting user profile image', ['path' => $user->image]);
                Storage::disk('public')->delete($user->image);
            }

            $user->delete();

            Toastr::success('User deleted successfully.', 'Success');
            Log::info('User deleted successfully', ['user_id' => $id]);
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while deleting the user.', 'Error');
            return redirect()->route('user.index');
        }
    }
}
