<?php

namespace App\Services;

use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;
use App\Models\ChatbotUserMessage;
use App\Models\ChatbotUserSession;
use Illuminate\Support\Carbon;

class ChatbotFlowService
{
    public function firstActiveQuestion(): ?ChatbotQuestion
    {
        return ChatbotQuestion::query()
            ->with('options')
            ->active()
            ->ordered()
            ->first();
    }

    public function logBotPrompt(ChatbotUserSession $session, ChatbotQuestion $question): void
    {
        $context = $session->context ?? [];
        $transcript = $context['transcript'] ?? [];
        $lastEntry = ! empty($transcript) ? end($transcript) : null;

        if (
            is_array($lastEntry)
            && ($lastEntry['sender'] ?? null) === 'bot'
            && (data_get($lastEntry, 'payload.question.id') === $question->id)
        ) {
            return;
        }

        $entry = [
            'sender' => 'bot',
            'at' => Carbon::now()->toIso8601String(),
            'payload' => [
                'question' => [
                    'id' => $question->id,
                    'title' => $question->title,
                    'prompt' => $question->prompt,
                    'type' => $question->type,
                ],
                'options' => $question->relationLoaded('options')
                    ? $question->options->map(fn (ChatbotOption $option) => [
                        'id' => $option->id,
                        'label' => $option->label,
                        'value' => $option->value,
                    ])->values()->all()
                    : [],
            ],
        ];

        $transcript[] = $entry;
        $context['transcript'] = $transcript;
        $session->update(['context' => $context]);
    }

    public function logUserMessage(
        ChatbotUserSession $session,
        ChatbotQuestion $question,
        ?ChatbotOption $option,
        ?string $inputValue,
        array $payload = []
    ): void {
        $serverPayload = [
            'question' => [
                'id' => $question->id,
                'title' => $question->title,
                'prompt' => $question->prompt,
                'type' => $question->type,
            ],
            'answer' => [
                'option_id' => $option?->id,
                'option_label' => $option?->label,
                'option_value' => $option?->value,
                'input_value' => $inputValue,
            ],
        ];

        $finalPayload = array_merge($serverPayload, $payload);

        $context = $session->context ?? [];
        $transcript = $context['transcript'] ?? [];
        $transcript[] = [
            'sender' => 'user',
            'at' => Carbon::now()->toIso8601String(),
            'payload' => $finalPayload,
        ];
        $context['transcript'] = $transcript;
        $session->update(['context' => $context]);
    }

    public function determineNextQuestion(ChatbotQuestion $question, ?ChatbotOption $option): ?ChatbotQuestion
    {
        if ($option && $option->nextQuestion) {
            return $option->nextQuestion;
        }

        if ($question->defaultNextQuestion) {
            return $question->defaultNextQuestion;
        }

        return null;
    }

    public function markSessionCompleted(ChatbotUserSession $session): void
    {
        $context = $session->context ?? [];
        $transcript = $context['transcript'] ?? [];

        if (! empty($transcript)) {
            ChatbotUserMessage::create([
                'session_id' => $session->id,
                'sender' => 'system',
                'payload' => [
                    'transcript' => $transcript,
                ],
                'sequence' => 1,
            ]);
        }

        $session->update([
            'status' => 'completed',
            'ended_at' => Carbon::now(),
        ]);
    }

    public function ensureSessionActive(ChatbotUserSession $session): void
    {
        if ($session->status !== 'active') {
            $session->update(['status' => 'active']);
        }

        if (! $session->started_at) {
            $session->update(['started_at' => Carbon::now()]);
        }
    }

    protected function nextSequence(ChatbotUserSession $session): int
    {
        $context = $session->context ?? [];
        $lastSequence = (int) ($context['sequence'] ?? 0);
        $next = $lastSequence + 1;
        $context['sequence'] = $next;
        $session->update(['context' => $context]);

        return $next;
    }
}
