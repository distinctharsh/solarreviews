<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
