<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'pincode',
        'service_type',
        'generation_variation',
        'use_location',
        'state_id',
        'city',
        'other_location',
        'name',
        'mobile_number',
        'email',
        'details',
        'company_id',
        'company_name',
        'company_slug',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
