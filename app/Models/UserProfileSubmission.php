<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileSubmission extends Model
{
    use HasFactory;

    public const FORM_DISTRIBUTOR = 'distributor';
    public const FORM_SUPPLIER = 'supplier';

    protected $fillable = [
        'user_id',
        'form_type',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
