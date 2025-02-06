<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Service;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuperadminDoctorController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all(); // Fetch all hospitals
        $doctors = User::with(['hospital', 'services'])
            ->where('role_id', 2) // Assuming `role_id` 2 is for doctors
            ->get(); // Fetch all doctors with their hospital and services relationships

        return view('superadmin.doctors.index', compact('hospitals', 'doctors'));
    }


    public function getServicesByHospital($hospitalId)
    {
        $services = Service::where('hospital_id', $hospitalId)->get();
        return response()->json($services);
    }


    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'hospital_id' => 'required|exists:hospitals,id',
                'services' => 'required|array',
                'services.*.id' => 'exists:services,id',
                'services.*.description' => 'nullable|string',
                'services.*.status' => 'required|in:0,1',
                'services.*.appointment_fees' => 'required|numeric|min:0',
            ]);

            // Log the incoming request data
            Log::info('Incoming Request Data:', $request->all());

            // Create doctor
            $doctor = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'hospital_id' => $request->hospital_id,
                'role_id' => 2, // Role ID for doctors
            ]);

            // Prepare services with pivot data
            $syncData = [];
            foreach ($request->services as $service) {
                $syncData[$service['id']] = [
                    'description' => $service['description'] ?? null,
                    'status' => $service['status'],
                    'appointment_fees' => $service['appointment_fees'],
                ];
            }

            // Log the services data before attaching
            Log::info('Services Data for Sync:', $syncData);

            // Attach services with pivot data
            $doctor->services()->sync($syncData);

            // Success log
            Log::info('Doctor successfully added.', ['doctor_id' => $doctor->id]);

            Toastr::success('Doctor added successfully!', 'Success');
            return redirect()->route('superadmin.doctors.index');
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error adding doctor:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            Toastr::error('Error adding doctor! Check logs for details.', 'Error');
            return redirect()->back()->withInput();
        }
    }


    public function update(Request $request, User $doctor)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $doctor->id,
                'hospital_id' => 'required|exists:hospitals,id',
                'services' => 'required|array',
                'services.*.id' => 'exists:services,id',
                'services.*.description' => 'nullable|string',
                'services.*.status' => 'required|in:0,1', // Ensure integer values for status
                'services.*.appointment_fees' => 'required|numeric|min:0',
            ]);

            // Update the doctor's basic details
            $doctor->update([
                'name' => $request->name,
                'email' => $request->email,
                'hospital_id' => $request->hospital_id,
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $doctor->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            // Sync updated services with pivot data
            $syncData = [];
            foreach ($request->services as $service) {
                $syncData[$service['id']] = [
                    'description' => $service['description'] ?? null,
                    'status' => $service['status'],
                    'appointment_fees' => $service['appointment_fees'],
                ];
            }

            // Log the updated sync data
            \Log::info('Updating services for doctor', ['doctor_id' => $doctor->id, 'services' => $syncData]);

            $doctor->services()->sync($syncData);

            Toastr::success('Doctor updated successfully!', 'Success');
            return redirect()->route('superadmin.doctors.index');
        } catch (\Exception $e) {
            // Log any errors for debugging
            \Log::error('Error updating doctor', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            Toastr::error('Error updating doctor!', 'Error');
            return redirect()->back()->withInput();
        }
    }


    public function destroy(User $doctor)
    {
        try {
            // Delete associated services first
            $doctor->services()->detach();

            // Delete the doctor
            $doctor->delete();

            Toastr::success('Doctor deleted successfully!', 'Success');
            return response()->json(['success' => true, 'message' => 'Doctor deleted successfully']);
        } catch (\Exception $e) {
            Toastr::error('Error deleting doctor!', 'Error');
            return response()->json(['success' => false, 'message' => 'Error deleting doctor'], 500);
        }
    }

    public function show(User $doctor)
    {
        $doctor->load(['services' => function ($query) {
            $query->select('services.id', 'services.name', 'status', 'description', 'appointment_fees');
        }]);

        return response()->json($doctor);
    }
}
