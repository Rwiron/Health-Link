<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\InsuranceProvider;
use App\Models\Payment;


class SuperadminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'total_hospitals' => Hospital::count(),
            'total_doctors' => User::where('role_id', 2)->count(),
            'total_patients' => User::where('role_id', 1)->count(),
            'total_bookings' => Booking::count(),
            'total_services' => Service::count(),
            'total_insurance' => InsuranceProvider::count(),
            'total_amount' => Payment::sum('total_amount'),
            'total_payments' => Payment::sum('final_amount'),
            'total_discounts' => Payment::sum('discount_amount'),
            'recent_bookings' => Booking::with(['user', 'hospital', 'doctor', 'service'])
                ->latest()
                ->take(5)
                ->get(),
            'recent_feedback' => Feedback::with('replies')
                ->latest()
                ->take(5)
                ->get(),
            'pending_bookings' => Booking::where('status', 'pending')
                ->with(['user', 'hospital', 'doctor', 'service'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('superadmin.dashboard', $data);
    }
}