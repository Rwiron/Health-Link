<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hospitals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'organization_type',
        'logo',
        'latitude',
        'longitude',
        'province',
        'district',
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

    // Relationship with Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relationship with Insurance Providers
    public function insuranceProviders()
    {
        return $this->hasMany(InsuranceProvider::class);
    }

    // Relationship with Appointments (through doctors)
    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class, User::class, 'hospital_id', 'doctor_id');
    }

    /**
     * Accessors & Mutators
     */

    // Example Accessor for Capitalized Name
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Example Mutator for Formatting Phone Number
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }
}