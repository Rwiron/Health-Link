<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DoctorReportController extends Controller
{
    // public function index($id = null)
    // {
    //     $doctorId = Auth::id();

    //     // Metrics
    //     $appointmentsCount = Appointment::where('doctor_id', $doctorId)->count();
    //     $acceptedAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'confirmed')->count();
    //     $pendingAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'pending')->count();
    //     $cancelledAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'cancelled')->count();
    //     $patientsCount = Appointment::where('doctor_id', $doctorId)->distinct('patient_id')->count('patient_id');

    //     // Appointment Details
    //     $appointments = Appointment::where('doctor_id', $doctorId)
    //         ->with('patient') // Assuming the `patient` relationship is defined
    //         ->latest('appointment_date')
    //         ->paginate(10);

    //     // Selected Appointment
    //     $selectedAppointment = $id ? Appointment::with('patient', 'doctor')->findOrFail($id) : null;

    //     return view('doctor.report.index', compact(
    //         'appointmentsCount',
    //         'acceptedAppointmentsCount',
    //         'pendingAppointmentsCount',
    //         'cancelledAppointmentsCount',
    //         'patientsCount',
    //         'appointments',
    //         'selectedAppointment'
    //     ));
    // }


    public function index($id = null)
    {
        $doctorId = Auth::id();

        // Metrics
        $appointmentsCount = Appointment::where('doctor_id', $doctorId)->count();
        $acceptedAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'confirmed')->count();
        $pendingAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'pending')->count();
        $cancelledAppointmentsCount = Appointment::where('doctor_id', $doctorId)->where('status', 'cancelled')->count();
        $patientsCount = Appointment::where('doctor_id', $doctorId)->distinct('patient_id')->count('patient_id');

        // Appointment Details
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient') // Assuming the `patient` relationship is defined
            ->latest('appointment_date')
            ->paginate(10);

        // Selected Appointment
        $selectedAppointment = $id ? Appointment::with(['patient', 'doctor.hospital'])->findOrFail($id) : null;

        // Authenticated Doctor
        $loggedInDoctor = Auth::user();

        return view('doctor.report.index', compact(
            'appointmentsCount',
            'acceptedAppointmentsCount',
            'pendingAppointmentsCount',
            'cancelledAppointmentsCount',
            'patientsCount',
            'appointments',
            'selectedAppointment',
            'loggedInDoctor'
        ));
    }






    public function invoice($id)
    {
        $patients = User::where('role_id', 1)->get(); // Patients list
        $appointment = Appointment::with('patient', 'doctor')->findOrFail($id);
        $doctor = $appointment->doctor;
        $hospital = $doctor->hospital ?? null; // Assuming the hospital relationship exists
        $invoice = $appointment->invoice; // Assuming appointment has an invoice relationship

        return view('doctor.report.invoice', compact('patients', 'appointment', 'doctor', 'hospital', 'invoice'));
    }
}
