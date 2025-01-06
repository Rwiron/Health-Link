<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AppointmentStatusUpdated extends Notification
{
    use Queueable;

    private $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        Log::info('Sending email to: ' . $notifiable->email); // Log the recipient email
        Log::info('Appointment ID: ' . $this->appointment->id);
        Log::info('Appointment Status: ' . $this->appointment->status);

        return (new MailMessage)
            ->subject('Appointment Status Updated')
            ->view(
                'emails.appointment_status',
                ['appointment' => $this->appointment] // Pass data to the view
            );
    }
}
