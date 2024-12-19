<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class DoctorAvailableController extends Controller
{
    /**
     * Display a listing of doctor availabilities.
     */
    public function index()
    {
        $availabilities = DoctorAvailability::with('doctor')->get(); // Ensure the 'doctor' relationship is defined
        return view('appointments.availability', compact('availabilities'));
    }

    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
        Log::info('Attempting to store a new appointment', ['request_data' => $request->all()]);

        try {
            // Validate the incoming request
            $request->validate([
                'doctor_id' => 'required|exists:users,id',
                'appointment_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'notes' => 'nullable|string',
            ]);

            // Log validated data
            Log::info('Validated request data', [
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->appointment_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            // Create the appointment
            Appointment::create([
                'patient_id' => Auth::id(),
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->appointment_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            Log::info('Appointment created successfully', ['user_id' => Auth::id()]);

            Toastr::success('Appointment booked successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error storing appointment: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            Toastr::error('An error occurred while booking the appointment. Please try again.', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
