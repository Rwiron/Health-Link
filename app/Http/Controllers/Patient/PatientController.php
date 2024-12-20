<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
    {
        $appointments = Appointment::where('patient_id', Auth::id())->with('doctor')->get();
        return view('patient.dashboard', compact('appointments'));
    }

    public function patientDashboard() {}
}
