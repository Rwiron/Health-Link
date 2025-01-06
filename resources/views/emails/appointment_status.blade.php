<!DOCTYPE html>
<html>

<head>
    <title>Appointment Status Updated</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://cdn-icons-png.flaticon.com/512/602/602182.png" alt="Logo" style="width: 80px; border-radius: 50%; margin-bottom: 10px;">
            <h1 style="font-size: 24px; color: #333;">Appointment Status Updated</h1>
        </div>
        <p style="font-size: 16px; color: #555;">Dear <strong>{{ $appointment->patient->name }}</strong>,</p>
        <p style="font-size: 16px; color: #333;">Your appointment (ID: {{ $appointment->id }}) has been updated.</p>
        <p style="font-size: 16px; color: #333;">New Status:
            <span style="{{ $appointment->status === 'confirmed' ? 'color: green;' : ($appointment->status === 'cancelled' ? 'color: red;' : 'color: orange;') }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </p>
        <p style="font-size: 16px; color: #333;">Appointment Date: {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</p>
        <div style="background-color: #f2f2f2; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3 style="font-size: 18px; color: #333; margin-bottom: 10px;">Details:</h3>
            <p style="font-size: 14px; color: #555; margin: 5px 0;">Appointment ID: {{ $appointment->id }}</p>
            <p style="font-size: 14px; color: #555; margin: 5px 0;">Doctor: {{ $appointment->doctor->name }}</p>
            <p style="font-size: 14px; color: #555; margin: 5px 0;">Status: {{ ucfirst($appointment->status) }}</p>
        </div>
        <p style="font-size: 16px; color: #555;">Thank you for choosing our service!</p>
        <p style="font-size: 16px; color: #555;">Best Regards,</p>
        <p style="font-size: 16px; color: #555;"><strong>The Health Link management System Team</strong></p>
    </div>
</body>

</html>
