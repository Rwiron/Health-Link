<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceProvider extends Model
{
    protected $table = 'insurance_providers';

    protected $fillable = [
        'name',
        'image',
    ];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'insurance_hospital', 'insurance_id', 'hospital_id');
    }
}
