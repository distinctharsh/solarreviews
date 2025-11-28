<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotUserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_uuid',
        'source',
        'status',
        'context',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'context' => 'array',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatbotUserMessage::class, 'session_id')->orderBy('sequence');
    }
}
