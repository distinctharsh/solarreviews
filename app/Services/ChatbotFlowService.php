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

    public function logBotPrompt(ChatbotUserSession $session, ChatbotQuestion $question): ChatbotUserMessage
    {
        $lastMessage = $session->messages()->latest('sequence')->first();

        if ($lastMessage && $lastMessage->sender === 'bot' && $lastMessage->question_id === $question->id) {
            return $lastMessage;
        }

        return $session->messages()->create([
            'question_id' => $question->id,
            'sender' => 'bot',
            'sequence' => $this->nextSequence($session),
        ]);
    }

    public function logUserMessage(
        ChatbotUserSession $session,
        ChatbotQuestion $question,
        ?ChatbotOption $option,
        ?string $inputValue,
        array $payload = []
    ): ChatbotUserMessage {
        return $session->messages()->create([
            'question_id' => $question->id,
            'option_id' => $option?->id,
            'sender' => 'user',
            'input_value' => $inputValue,
            'payload' => $payload ?: null,
            'sequence' => $this->nextSequence($session),
        ]);
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
        $lastSequence = $session->messages()->max('sequence');

        return $lastSequence ? $lastSequence + 1 : 1;
    }
}
