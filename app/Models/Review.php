<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Review extends Model
{
    use SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'product_id',
        'state_id',
        'title',
        'content',
        'rating',
        'author_name',
        'author_email',
        'author_location',
        'otp_code',
        'otp_expires_at',
        'is_verified',
        'status',
        'admin_notes',
        'approved_at',
        'approved_by',
        'user_ip',
        'user_agent',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($review) {
            $review->otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $review->otp_expires_at = now()->addHours(24); // OTP valid for 24 hours
            $review->user_ip = request()->ip();
            $review->user_agent = request()->userAgent();
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function verifyOtp(string $code): bool
    {
        if ($this->otp_code === $code && $this->otp_expires_at->isFuture()) {
            $this->is_verified = true;
            $this->otp_code = null;
            $this->otp_expires_at = null;
            return $this->save();
        }
        
        return false;
    }

    public function approve(int $approvedBy): bool
    {
        $this->status = self::STATUS_APPROVED;
        $this->approved_by = $approvedBy;
        $this->approved_at = now();
        return $this->save();
    }

    public function reject(int $rejectedBy, string $reason = null): bool
    {
        $this->status = self::STATUS_REJECTED;
        $this->approved_by = $rejectedBy;
        $this->approved_at = now();
        $this->admin_notes = $reason;
        return $this->save();
    }
}
