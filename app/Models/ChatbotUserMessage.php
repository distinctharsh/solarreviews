<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotUserMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'question_id',
        'option_id',
        'sender',
        'input_value',
        'payload',
        'sequence',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function session()
    {
        return $this->belongsTo(ChatbotUserSession::class, 'session_id');
    }

    public function question()
    {
        return $this->belongsTo(ChatbotQuestion::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(ChatbotOption::class, 'option_id');
    }
}
