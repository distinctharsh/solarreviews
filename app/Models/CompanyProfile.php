<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_type',
        'company_name',
        'brand_name',
        'website',
        'year_founded',
        'employee_count',
        'primary_goal',
        'production_capacity',
        'distribution_regions',
        'coverage_states',
        'installations_per_year',
        'certifications',
        'licenses',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'year_founded' => 'integer',
        'installations_per_year' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productLineTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProductLineType::class, 'company_product_line_type');
    }

    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(ServiceType::class, 'company_service_type');
    }
}
