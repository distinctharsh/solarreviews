<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'label',
        'value',
        'description',
        'display_order',
        'next_question_id',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(ChatbotQuestion::class, 'question_id');
    }

    public function nextQuestion()
    {
        return $this->belongsTo(ChatbotQuestion::class, 'next_question_id');
    }
}
