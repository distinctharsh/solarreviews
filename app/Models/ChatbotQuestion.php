<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatbotQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'prompt',
        'type',
        'is_required',
        'is_active',
        'display_order',
        'input_placeholder',
        'input_validation',
        'default_next_question_id',
    ];

    protected $casts = [
        'is_required' => 'bool',
        'is_active' => 'bool',
        'input_validation' => 'array',
    ];

    public function options()
    {
        return $this->hasMany(ChatbotOption::class, 'question_id')->orderBy('display_order');
    }

    public function defaultNextQuestion()
    {
        return $this->belongsTo(self::class, 'default_next_question_id');
    }

    public function incomingOptions()
    {
        return $this->hasMany(ChatbotOption::class, 'next_question_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }
}
