<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{

    public function index()
    {
        $appointments = Booking::where('user_id', auth()->id())
            ->with(['hospital', 'doctor', 'service', 'insurance'])
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('client.my-appointments', compact('appointments'));
    }

    public function store(Request $request)
    {
        Log::info('Received booking request', $request->all());

        // Log if the file exists in the request
        if ($request->hasFile('insurance_document')) {
            Log::info('Insurance document detected', [
                'file_name' => $request->file('insurance_document')->getClientOriginalName(),
                'mime_type' => $request->file('insurance_document')->getMimeType(),
                'size' => $request->file('insurance_document')->getSize()
            ]);
        } else {
            Log::warning('No insurance document uploaded in the request');
        }

        // Validate input
        $validated = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'insurance_id' => 'nullable|exists:insurance_providers,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'insurance_document' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        Log::info('Validation passed', ['validated_data' => $validated]);

        $insuranceDocPath = null;

        if ($request->hasFile('insurance_document')) {
            try {
                Log::info('Attempting to upload insurance document');

                $insuranceDocPath = $request->file('insurance_document')->store('insurance_docs', 'public');

                Log::info('Insurance document uploaded successfully', ['path' => $insuranceDocPath]);
            } catch (\Exception $e) {
                Log::error('Error uploading insurance document', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('No insurance document uploaded');
        }

        try {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'hospital_id' => $request->hospital_id,
                'doctor_id' => $request->doctor_id,
                'service_id' => $request->service_id,
                'insurance_id' => $request->insurance_id,
                'insurance_document' => $insuranceDocPath ?? 'None',
                'booking_date' => $request->booking_date,
                'status' => 'pending',
            ]);

            Log::info('Booking created successfully', [
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'hospital_id' => $request->hospital_id,
                'booking_date' => $request->booking_date,
                'insurance_document' => $insuranceDocPath
            ]);

            Toastr::success('Appointment successfully booked.', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to create booking', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
                'hospital_id' => $request->hospital_id
            ]);

            Toastr::error('Failed to book appointment. Please try again.', 'Error');
            return redirect()->back();
        }
    }


    public function cancel($id)
    {
        $appointment = Booking::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete appointment
        $appointment->delete();

        return redirect()->route('client.bookings.index')->with('success', 'Appointment canceled successfully.');
    }
}
