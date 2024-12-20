<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctorId = Auth::id();

        // Metrics
        $doctorsCount = User::where('role_id', 2)->count(); // Role ID for Doctor is 2
        $patientsCount = User::where('role_id', 1)->count(); // Role ID for Patient is 1
        $appointmentsCount = Appointment::where('doctor_id', $doctorId)->count();
        $latestAppointments = Appointment::get(); // Use get() without pagination



        // Latest Appointments
        $latestAppointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient') // Assuming the relationship is defined in the model
            ->latest('appointment_date')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact(
            'doctorsCount',
            'patientsCount',
            'appointmentsCount',
            'latestAppointments'
        ));
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the doctor owns the appointment
        if ($appointment->doctor_id !== auth()->id()) {
            session()->flash('error', 'You are not authorized to update this appointment.');
            return redirect()->back();
        }

        $appointment->status = $request->status;
        $appointment->save();

        session()->flash('success', 'Appointment status updated successfully.');
        return redirect()->back();
    }
}
