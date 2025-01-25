<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'hospital_id' => 'required|exists:hospitals,id',
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $doctor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hospital_id' => $request->hospital_id,
            'role_id' => 2, // Role ID for doctors
        ]);

        // Attach services
        $doctor->services()->sync($request->service_ids);

        return redirect()->route('superadmin.doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function update(Request $request, User $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'hospital_id' => 'required|exists:hospitals,id',
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'hospital_id' => $request->hospital_id,
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|confirmed'
            ]);

            $doctor->update([
                'password' => bcrypt($request->password)
            ]);
        }

        // Sync services
        $doctor->services()->sync($request->service_ids);

        return redirect()->route('superadmin.doctors.index')->with('success', 'Doctor updated successfully.');
    }
}