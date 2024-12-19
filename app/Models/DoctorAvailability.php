<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctor_availabilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'available_date',
        'start_time',
        'end_time',
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
    

    /**
     * Accessors & Mutators
     */

    // Example Accessor for Human-Readable Date
    public function getAvailableDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('l, F j, Y');
    }

    // Example Accessor for Formatted Start Time
    public function getStartTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('h:i A');
    }

    // Example Accessor for Formatted End Time
    public function getEndTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('h:i A');
    }

    // Example Mutator for Ensuring Consistent Date Format
    public function setAvailableDateAttribute($value)
    {
        $this->attributes['available_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
