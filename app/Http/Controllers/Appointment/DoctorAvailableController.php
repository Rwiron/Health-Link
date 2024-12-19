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
        if (!Auth::check()) {
            Log::warning('Unauthenticated access attempt to doctor availabilities.');
            Toastr::error('You must be logged in to view doctor availabilities.', 'Error');
            return redirect()->route('login');
        }

        if (Auth::user()->role->name !== 'Patient') {
            Log::warning('Unauthorized access to doctor availabilities.', [
                'user_id' => Auth::id(),
                'role' => Auth::user()->role->name,
            ]);
            Toastr::error('Access denied. This page is for patients only.', 'Access Denied');
            return redirect()->route('login');
        }

        $availabilities = DoctorAvailability::with('doctor')->get();
        $appointments = Appointment::where('patient_id', Auth::id())->orderBy('appointment_date', 'desc')->get();

        Log::info('Doctor availabilities fetched successfully for user ID: ' . Auth::id());

        return view('appointments.availability', compact('availabilities', 'appointments'));
    }


    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
        Log::info('Authenticated user:', ['user_id' => Auth::id()]);

        if (!Auth::check()) {
            Log::error('User is not authenticated.');
            Toastr::error('You must be logged in to book an appointment.', 'Error');
            return redirect()->route('login');
        }

        if (Auth::user()->role->name !== 'Patient') {
            Log::warning('Unauthorized booking attempt.', [
                'user_id' => Auth::id(),
                'role' => Auth::user()->role->name,
            ]);
            Toastr::error('You do not have permission to book an appointment.', 'Access Denied');
            return redirect()->route('login');
        }

        try {
            $request->validate([
                'doctor_id' => 'required|exists:users,id',
                'appointment_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'notes' => 'nullable|string',
            ]);

            Appointment::create([
                'patient_id' => Auth::id(),
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->appointment_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            Log::info('Appointment created successfully for user ID: ' . Auth::id());
            Toastr::success('Appointment booked successfully!', 'Success');
            return redirect()->route('patient.dashboard');
        } catch (\Exception $e) {
            Log::error('Error storing appointment: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('An error occurred while booking the appointment. Please try again.', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
