<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'site_name',
        'site_location',
        'total_capacity_kw',
        'installation_type',
        'financial_model',
        'average_generation_units_per_kw_year',
        'contact_no',
        'email_id',
        'show_contact_on_frontend',
        'show_email_on_frontend',
    ];

    protected $casts = [
        'total_capacity_kw' => 'decimal:2',
        'average_generation_units_per_kw_year' => 'decimal:2',
        'show_contact_on_frontend' => 'boolean',
        'show_email_on_frontend' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}
