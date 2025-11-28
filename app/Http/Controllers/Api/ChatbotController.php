<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;
use App\Models\ChatbotUserSession;
use App\Services\ChatbotFlowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function __construct(private readonly ChatbotFlowService $flowService)
    {
    }

    public function bootstrap(Request $request): JsonResponse
    {
        $session = $this->getOrCreateSession($request);
        $question = $this->flowService->firstActiveQuestion();

        if (! $question) {
            return response()->json(['message' => 'Chatbot is not configured.'], 404);
        }

        $this->flowService->ensureSessionActive($session);
        $this->flowService->logBotPrompt($session, $question);

        return response()->json([
            'session_id' => $session->id,
            'visitor_uuid' => $session->visitor_uuid,
            'question' => $this->formatQuestion($question),
        ]);
    }

    public function answer(Request $request): JsonResponse
    {
        $data = $request->validate([
            'session_id' => 'required|exists:chatbot_user_sessions,id',
            'question_id' => 'required|exists:chatbot_questions,id',
            'option_id' => 'nullable|exists:chatbot_options,id',
            'input_value' => 'nullable|string|max:1000',
            'payload' => 'nullable|array',
        ]);

        $session = ChatbotUserSession::findOrFail($data['session_id']);
        $question = ChatbotQuestion::findOrFail($data['question_id']);
        $option = isset($data['option_id']) ? ChatbotOption::findOrFail($data['option_id']) : null;

        $this->flowService->ensureSessionActive($session);

        $this->flowService->logUserMessage(
            $session,
            $question,
            $option,
            $data['input_value'] ?? null,
            $data['payload'] ?? []
        );

        $nextQuestion = $this->flowService->determineNextQuestion($question, $option);

        if (! $nextQuestion) {
            $this->flowService->markSessionCompleted($session);

            return response()->json([
                'completed' => true,
                'message' => 'Conversation completed. Thank you!',
            ]);
        }

        $this->flowService->logBotPrompt($session, $nextQuestion);

        return response()->json([
            'completed' => false,
            'question' => $this->formatQuestion($nextQuestion),
        ]);
    }

    protected function formatQuestion(ChatbotQuestion $question): array
    {
        return [
            'id' => $question->id,
            'title' => $question->title,
            'prompt' => $question->prompt,
            'type' => $question->type,
            'is_required' => $question->is_required,
            'input_placeholder' => $question->input_placeholder,
            'input_validation' => $question->input_validation,
            'options' => $question->options->map(function (ChatbotOption $option) {
                return [
                    'id' => $option->id,
                    'label' => $option->label,
                    'description' => $option->description,
                    'value' => $option->value,
                ];
            })->values(),
        ];
    }

    protected function getOrCreateSession(Request $request): ChatbotUserSession
    {
        $visitorUuid = $request->cookie('chatbot_visitor_uuid') ?: (string) Str::uuid();

        $session = ChatbotUserSession::firstOrCreate(
            [
                'visitor_uuid' => $visitorUuid,
                'status' => 'active',
            ],
            [
                'source' => $request->input('source', 'website'),
                'started_at' => now(),
            ]
        );

        if ($session->wasRecentlyCreated) {
            cookie()->queue(cookie('chatbot_visitor_uuid', $visitorUuid, 60 * 24 * 30));
        }

        return $session;
    }
}
