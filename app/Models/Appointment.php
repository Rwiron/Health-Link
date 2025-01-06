<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'start_time', // Add start_time
        'end_time',   // Add end_time
        'status',
        'notes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Relationships
     */

    // Relationship with Doctor (User)
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relationship with Patient (User)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    

    /**
     * Accessors & Mutators
     */

    // Example Accessor for Formatted Appointment Date
    public function getAppointmentDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('l, F j, Y h:i A');
    }

    // Example Mutator for Consistent Appointment Date Format
    public function setAppointmentDateAttribute($value)
    {
        $this->attributes['appointment_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Scopes
     */

    // Scope for filtering by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope for filtering by doctor
    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    // Scope for filtering by patient
    public function scopeByPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    /**
     * Utility Methods
     */

    // Check if the appointment is confirmed
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    // Check if the appointment is canceled
    public function isCanceled()
    {
        return $this->status === 'canceled';
    }
}
