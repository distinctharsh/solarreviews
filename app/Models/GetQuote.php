<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GetQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'state_id',
        'service_type',
        'name',
        'mobile_number',
        'email',
        'location',
        'notes',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
