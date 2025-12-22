<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NormalUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'provider',
        'provider_id',
        'avatar_url',
        'last_login_at',
        'last_activity_at',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(CompanyReview::class);
    }
}
