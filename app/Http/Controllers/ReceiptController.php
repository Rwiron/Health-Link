<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;  // Use the correct model

class ReceiptController extends Controller
{
    public function printReceipt($id)
    {
        // Fetch the booking details
        $booking = Booking::find($id);

        // Ensure booking exists before proceeding
        if (!$booking) {
            return abort(404, 'Booking Not Found.');
        }

        // Fetch the payment associated with the booking
        $payment = Payment::where('booking_id', $id)->first();

        // Ensure payment exists before proceeding
        if (!$payment) {
            return abort(404, 'Payment Not Found.');
        }

        // Return the view with booking and payment details
        return view('receipt', compact('payment', 'booking'));
    }
}