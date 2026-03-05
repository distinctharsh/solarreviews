<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolarEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity',
        'category',
        'net_metering',
        'type',
        'tin_shed_age',
        'distance_from_substation',
        'line',
        'name',
        'mobile_number',
        'email',
        'notes',
        'use_location',
        'state_id',
        'city',
        'city_id',
        'pincode',
        'other_location',
        'other',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'capacity' => 'decimal:2',
        'tin_shed_age' => 'integer',
        'distance_from_substation' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: enquiry belongs to a state.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function linkedCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Relationship: enquiry belongs to a city (for city name field).
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
