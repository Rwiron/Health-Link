<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;


class DoctorController extends Controller
{
    // Doctor Dashboard
    public function dashboard()
    {
        $doctorId = Auth::id();

        // Metrics
        $patientsCount = Booking::where('doctor_id', $doctorId)->distinct('user_id')->count('user_id');
        $appointmentsCount = Booking::where('doctor_id', $doctorId)->count();

        // Appointment Status Counts
        $acceptedAppointmentsCount = Booking::where('doctor_id', $doctorId)->where('status', 'confirmed')->count();
        $pendingAppointmentsCount = Booking::where('doctor_id', $doctorId)->where('status', 'pending')->count();
        $cancelledAppointmentsCount = Booking::where('doctor_id', $doctorId)->where('status', 'cancelled')->count();

        // Latest Appointments
        $latestAppointments = Booking::where('doctor_id', $doctorId)
            ->with(['user', 'service']) // Ensure relationships are correct
            ->latest('booking_date')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact(
            'patientsCount',
            'appointmentsCount',
            'acceptedAppointmentsCount',
            'pendingAppointmentsCount',
            'cancelledAppointmentsCount',
            'latestAppointments'
        ));
    }

    // View Appointments
    // public function appointments1()
    // {
    //     $doctorId = Auth::id();
    //     $appointments = Booking::where('doctor_id', $doctorId)
    //         ->with(['user', 'service', 'insurance'])
    //         ->orderBy('booking_date', 'desc')
    //         ->get();

    //     return view('doctor.appointments.index', compact('appointments'));
    // }


    public function appointments()
    {
        $doctorId = auth()->id();
        $appointments = Booking::where('doctor_id', $doctorId)
            ->with(['patient', 'insurance', 'service'])
            ->get();

        return view('doctor.appointments.index', compact('appointments'));
    }

    // Update Appointment Status
    // public function updateStatus1(Request $request)
    // {
    //     $request->validate([
    //         'appointment_id' => 'required|exists:bookings,id',
    //         'status' => 'required|in:pending,confirmed,cancelled,completed',
    //     ]);

    //     $appointment = Booking::findOrFail($request->appointment_id);

    //     // Ensure doctor owns the appointment
    //     if ($appointment->doctor_id !== Auth::id()) {
    //         Log::warning('Unauthorized attempt to update booking.', [
    //             'doctor_id' => Auth::id(),
    //             'appointment_id' => $request->appointment_id,
    //         ]);
    //         Toastr::error('You are not authorized to update this appointment.', 'Unauthorized');
    //         return redirect()->back();
    //     }

    //     $appointment->status = $request->status;
    //     $appointment->save();

    //     Log::info('Booking status updated.', [
    //         'appointment_id' => $appointment->id,
    //         'status' => $appointment->status,
    //     ]);

    //     Toastr::success('Appointment status updated successfully.', 'Success');
    //     return redirect()->back();
    // }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:bookings,id',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment = Booking::findOrFail($request->appointment_id);

        // Ensure doctor owns the appointment
        if ($appointment->doctor_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $appointment->status = $request->status;
        $appointment->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }


    // Get Booking Statistics (for charts)
    public function getBookingStatistics()
    {
        $doctorId = Auth::id();

        $data = [
            'labels' => ['Pending', 'Confirmed', 'Cancelled', 'Completed'],
            'series' => [
                Booking::where('doctor_id', $doctorId)->where('status', 'pending')->count(),
                Booking::where('doctor_id', $doctorId)->where('status', 'confirmed')->count(),
                Booking::where('doctor_id', $doctorId)->where('status', 'cancelled')->count(),
                Booking::where('doctor_id', $doctorId)->where('status', 'completed')->count(),
            ],
        ];


        return response()->json($data);
    }



    public function applyDiscount(Request $request, $id)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($id);
        $servicePrice = $booking->service->price;
        $discount = $request->discount;
        $finalAmount = $servicePrice - $discount;

        // Save payment details
        Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'total_amount' => $servicePrice,
                'discount_amount' => $discount,
                'final_amount' => $finalAmount,
                'status' => 'pending'
            ]
        );

        Toastr::success('Discount applied successfully.');
        return redirect()->back();
    }
}
