<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    public const TYPE_DISTRIBUTOR = 'distributor';
    public const TYPE_MANUFACTURER = 'manufacturer';

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'company_type',
        'about',
        'logo',
        'website',
        'phone',
        'email',
        'years_in_business',
        'gst_number',
        'state_id',
        'city_id',
        'address_line1',
        'address_line2',
        'postal_code',
        'service_area',
        'certifications',
        'licenses',
        'meta',
        'coverage_states',
        'installations_per_year',
        'production_capacity',
        'distribution_regions',
        'average_rating',
        'total_reviews',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'average_rating' => 'float',
        'years_in_business' => 'integer',
        'installations_per_year' => 'integer',
        'total_reviews' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Company $company) {
            if (empty($company->slug)) {
                $company->slug = Str::slug($company->name);
            }
        });

        static::updating(function (Company $company) {
            if ($company->isDirty('name') && empty($company->slug)) {
                $company->slug = Str::slug($company->name);
            }
        });
    }

    /**
     * Relationship: Company owner.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Relationship: Company belongs to a state.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Relationship: Company belongs to a city.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Relationship: Company has many products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relationship: Company has many reviews.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(CompanyReview::class);
    }

    /**
     * Relationship: Company categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'company_category')->withTimestamps();
    }

    /**
     * Relationship: Company brands.
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'company_brand')->withTimestamps();
    }

    /**
     * Helper: available company types for forms.
     */
    public static function getTypeOptions(): array
    {
        return [
            self::TYPE_DISTRIBUTOR => 'Distributor / Service Provider',
            self::TYPE_MANUFACTURER => 'Manufacturer / OEM',
        ];
    }

    /**
     * Accessor for logo URL.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset($this->logo) : null;
    }
}
