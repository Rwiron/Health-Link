<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class DoctorAvailabilityController extends Controller
{
    /**
     * Display a listing of doctor availabilities.
     */
    public function index()
    {
        Log::info('Fetching doctor availabilities');
        $availabilities = DoctorAvailability::with('doctor')->get();
        $doctors = User::whereHas('role', function ($query) {
            $query->where('name', 'Doctor'); // Ensure only doctors are listed
        })->get();

        return view('doctor.availability.index', compact('availabilities', 'doctors'));
    }

    /**
     * Store a newly created doctor availability in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Storing new doctor availability', ['request' => $request->all()]);
            $request->validate([
                'doctor_id' => 'required|exists:users,id',
                'available_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            DoctorAvailability::create($request->all());

            Toastr::success('Doctor availability added successfully.', 'Success');
            Log::info('Doctor availability added successfully');
            return redirect()->route('doctor.availability.index');
        } catch (\Exception $e) {
            Log::error('Error adding doctor availability: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while adding the doctor availability.', 'Error');
            return redirect()->route('doctor.availability.index');
        }
    }

    /**
     * Update the specified doctor availability in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Updating doctor availability', ['id' => $id, 'request' => $request->all()]);
            $request->validate([
                'doctor_id' => 'required|exists:users,id',
                'available_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $availability = DoctorAvailability::findOrFail($id);
            $availability->update($request->all());

            Toastr::success('Doctor availability updated successfully.', 'Success');
            Log::info('Doctor availability updated successfully', ['id' => $id]);
            return redirect()->route('doctor.availability.index');
        } catch (\Exception $e) {
            Log::error('Error updating doctor availability: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while updating the doctor availability.', 'Error');
            return redirect()->route('doctor.availability.index');
        }
    }

    /**
     * Remove the specified doctor availability from storage.
     */
    public function destroy($id)
    {
        try {
            Log::info('Deleting doctor availability', ['id' => $id]);
            $availability = DoctorAvailability::findOrFail($id);
            $availability->delete();

            Toastr::success('Doctor availability deleted successfully.', 'Success');
            Log::info('Doctor availability deleted successfully', ['id' => $id]);
            return redirect()->route('doctor.availability.index');
        } catch (\Exception $e) {
            Log::error('Error deleting doctor availability: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while deleting the doctor availability.', 'Error');
            return redirect()->route('doctor.availability.index');
        }
    }
}
