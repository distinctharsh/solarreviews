<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserProfileSubmission;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const TYPE_DISTRIBUTOR = 'distributor';
    public const TYPE_MANUFACTURER = 'manufacturer';
    public const TYPE_SUPPLIER = 'supplier';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type_id',
        'company_id',
        'status',
        'role',
        'is_admin',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function isDistributor(): bool
    {
        return $this->userType?->slug === self::TYPE_DISTRIBUTOR;
    }

    public function isManufacturer(): bool
    {
        return $this->userType?->slug === self::TYPE_MANUFACTURER;
    }

    public function isSupplier(): bool
    {
        return $this->userType?->slug === self::TYPE_SUPPLIER;
    }

    /**
     * Relationship: User owns a company
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

    public function profileSubmissions(): HasMany
    {
        return $this->hasMany(UserProfileSubmission::class);
    }

    public function hasCompletedProfileForm(string $formType): bool
    {
        if (! Schema::hasTable('user_profile_submissions')) {
            return false;
        }

        return $this->profileSubmissions()
            ->where('form_type', $formType)
            ->exists();
    }
}
