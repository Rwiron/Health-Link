<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AppointmentController extends Controller
{
    // Display all appointments with doctors and patients
    public function index()
    {
        try {
            $appointments = Appointment::with('doctor', 'patient')->get();
            $doctors = User::where('role_id', 3)->get(); // Assuming '3' is the role ID for doctors

            Toastr::info('Appointments fetched successfully.', 'Info');
            return view('appointments.index', compact('appointments', 'doctors'));
        } catch (\Exception $e) {
            Toastr::error('An error occurred while fetching appointments.', 'Error');
            return redirect()->back();
        }
    }

    // Store a new appointment
    public function store(Request $request)
    {
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

            Toastr::success('Appointment booked successfully!', 'Success');
            return redirect()->route('appointment.doctor-availability.index');
        } catch (\Exception $e) {
            Toastr::error('An error occurred while booking the appointment.', 'Error');
            return redirect()->back()->withInput();
        }
    }

    // Update an appointment
    public function update(Request $request, $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);

            $request->validate([
                'appointment_date' => 'required|date|after_or_equal:today',
                'time_slot' => 'required|string',
                'notes' => 'nullable|string',
                'status' => 'required|in:pending,confirmed,cancelled',
            ]);

            $appointment->update([
                'appointment_date' => $request->appointment_date,
                'time_slot' => $request->time_slot,
                'notes' => $request->notes,
                'status' => $request->status,
            ]);

            Toastr::success('Appointment updated successfully!', 'Success');
            return redirect()->route('appointment.doctor-availability.index');
        } catch (\Exception $e) {
            Toastr::error('An error occurred while updating the appointment.', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
