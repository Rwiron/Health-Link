<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hospital_id',
        'doctor_id',
        'service_id',
        'insurance_id',
        'insurance_document', // New column
        'booking_date',
        'status'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id'); // Doctor is also a user
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function insurance()
    {
        return $this->belongsTo(InsuranceProvider::class);
    }


    // public function getInsuranceDocumentAttribute($value)
    // {
    //     return $value ? 'insurance_documents/' . $value : null;
    // }
}
