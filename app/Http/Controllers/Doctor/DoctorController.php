<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\AppointmentStatusUpdated;
use Illuminate\Support\Facades\Log;


class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctorId = Auth::id();

        // Metrics
        $doctorsCount = User::where('role_id', 2)->count();
        $patientsCount = Appointment::where('doctor_id', $doctorId)->distinct('patient_id')->count('patient_id');
        $appointmentsCount = Appointment::where('doctor_id', $doctorId)->count();

        // Appointment Status Counts
        $acceptedAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'confirmed')->count();
        $pendingAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'pending')->count();
        $cancelledAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'cancelled')->count();

        // Latest Appointments
        $latestAppointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient') // Assuming 'patient' is a valid relationship
            ->latest('appointment_date')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact(
            'doctorsCount',
            'patientsCount',
            'appointmentsCount',
            'acceptedAppointmentsCount',
            'pendingAppointmentsCount',
            'cancelledAppointmentsCount',
            'latestAppointments'
        ));
    }

    // public function updateStatus(Request $request)
    // {
    //     $request->validate([
    //         'appointment_id' => 'required|exists:appointments,id',
    //         'status' => 'required|in:pending,confirmed,cancelled',
    //     ]);

    //     $appointment = Appointment::findOrFail($request->appointment_id);

    //     // Ensure the doctor owns the appointment
    //     if ($appointment->doctor_id !== auth()->id()) {
    //         Toastr::error('You are not authorized to update this appointment.', 'Unauthorized');
    //         return redirect()->back();
    //     }

    //     $appointment->status = $request->status;
    //     $appointment->save();

    //     Toastr::success('Appointment status updated successfully.', 'Success');
    //     return redirect()->back();
    // }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the doctor owns the appointment
        if ($appointment->doctor_id !== auth()->id()) {
            Log::warning('Unauthorized attempt to update appointment.', [
                'doctor_id' => auth()->id(),
                'appointment_id' => $request->appointment_id,
            ]);
            Toastr::error('You are not authorized to update this appointment.', 'Unauthorized');
            return redirect()->back();
        }

        $appointment->status = $request->status;
        $appointment->save();

        \Log::info('Appointment status updated.', [
            'appointment_id' => $appointment->id,
            'status' => $appointment->status,
        ]);

        // Send Notification to the Patient
        $appointment->patient->notify(new AppointmentStatusUpdated($appointment));
        \Log::info('Notification sent to patient.', [
            'patient_email' => $appointment->patient->email,
            'appointment_id' => $appointment->id,
        ]);

        Toastr::success('Appointment status updated successfully.', 'Success');
        return redirect()->back();
    }


    public function getOrderStatistics()
    {
        $doctorId = Auth::id();

        $data = [
            'labels' => ['Pending', 'Confirmed', 'Cancelled'],
            'series' => [
                Appointment::where('doctor_id', $doctorId)->where('status', 'pending')->count(),
                Appointment::where('doctor_id', $doctorId)->where('status', 'confirmed')->count(),
                Appointment::where('doctor_id', $doctorId)->where('status', 'cancelled')->count(),
            ],
        ];

        return response()->json($data);
    }
}
