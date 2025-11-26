<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * User Types
     */
    const TYPE_REGULAR = 'regular';
    const TYPE_DISTRIBUTOR = 'distributor';
    const TYPE_MANUFACTURER = 'manufacturer';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type',
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

    /**
     * Check if the user is a distributor
     */
    public function isDistributor(): bool
    {
        return $this->user_type === self::TYPE_DISTRIBUTOR;
    }

    /**
     * Check if the user is a manufacturer
     */
    public function isManufacturer(): bool
    {
        return $this->user_type === self::TYPE_MANUFACTURER;
    }

    /**
     * Get user type options for forms
     */
    public static function getUserTypeOptions(): array
    {
        return [
            self::TYPE_DISTRIBUTOR => 'Distributor',
            self::TYPE_MANUFACTURER => 'Manufacturer',
        ];
    }

    /**
     * Relationship: User owns a company
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'owner_id');
    }
}
