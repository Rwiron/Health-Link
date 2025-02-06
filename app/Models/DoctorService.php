<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
    use HasFactory;

    protected $table = 'doctor_service'; // Define the pivot table name

    protected $fillable = [
        'doctor_id',
        'service_id',
        'description',
        'status',
        'appointment_fees'
    ];

    // Define relationships
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
