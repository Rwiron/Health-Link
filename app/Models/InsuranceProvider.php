<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceProvider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insurance_providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hospital_id',
        'image',
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

    // Relationship with Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Accessors & Mutators
     */

    // Example Accessor for Capitalized Name
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Example Mutator for Standardizing the Name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower(trim($value));
    }


    public function scopeByHospital($query, $hospitalId)
    {
        return $query->where('hospital_id', $hospitalId);
    }


}