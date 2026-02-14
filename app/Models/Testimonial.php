<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_company',
        'project_type',
        'testimonial_text',
        'rating',
        'customer_image',
        'show_on_frontend',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'show_on_frontend' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeVisible($query)
    {
        return $query->where('show_on_frontend', true);
    }

    public function scopeForFrontend($query)
    {
        return $query->approved()->visible();
    }
}
