<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ChatbotQuestionController extends Controller
{
    public function index(): View
    {
        $questions = ChatbotQuestion::with('defaultNextQuestion')
            ->ordered()
            ->paginate(20);

        return view('admin.chatbot.questions.index', compact('questions'));
    }

    public function create(): View
    {
        $otherQuestions = ChatbotQuestion::ordered()->pluck('title', 'id');

        return view('admin.chatbot.questions.create', compact('otherQuestions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateQuestion($request);

        $question = ChatbotQuestion::create($validated);

        return redirect()
            ->route('admin.chatbot.questions.show', $question)
            ->with('success', 'Question created successfully.');
    }

    public function show(ChatbotQuestion $question): View
    {
        $question->load(['options.nextQuestion', 'defaultNextQuestion']);
        $otherQuestions = ChatbotQuestion::where('id', '!=', $question->id)
            ->ordered()
            ->pluck('title', 'id');

        return view('admin.chatbot.questions.show', compact('question', 'otherQuestions'));
    }

    public function edit(ChatbotQuestion $question): View
    {
        $otherQuestions = ChatbotQuestion::where('id', '!=', $question->id)
            ->ordered()
            ->pluck('title', 'id');

        return view('admin.chatbot.questions.edit', compact('question', 'otherQuestions'));
    }

    public function update(Request $request, ChatbotQuestion $question): RedirectResponse
    {
        $validated = $this->validateQuestion($request, $question->id);

        $question->update($validated);

        return redirect()
            ->route('admin.chatbot.questions.show', $question)
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(ChatbotQuestion $question): RedirectResponse
    {
        DB::transaction(function () use ($question) {
            ChatbotQuestion::where('default_next_question_id', $question->id)
                ->update(['default_next_question_id' => null]);

            ChatbotOption::where('next_question_id', $question->id)
                ->update(['next_question_id' => null]);

            $question->options()->delete();
            $question->delete();
        });

        return redirect()
            ->route('admin.chatbot.questions.index')
            ->with('success', 'Question deleted successfully.');
    }

    protected function validateQuestion(Request $request, ?int $questionId = null): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prompt' => 'required|string',
            'type' => 'required|string|in:choice,input,text,number,email,phone',
            'display_order' => 'nullable|integer|min:0',
            'default_next_question_id' => 'nullable|exists:chatbot_questions,id',
            'input_placeholder' => 'nullable|string|max:255',
        ]);

        if ($questionId && ($validated['default_next_question_id'] ?? null) === $questionId) {
            throw ValidationException::withMessages([
                'default_next_question_id' => 'Default next question cannot reference the same question.',
            ]);
        }

        $validated['display_order'] = $validated['display_order'] ?? 0;
        $validated['is_required'] = $request->boolean('is_required');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['input_validation'] = $this->parseInputValidation($request);

        return $validated;
    }

    protected function parseInputValidation(Request $request): ?array
    {
        $raw = $request->input('input_validation');

        if ($raw === null || $raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            throw ValidationException::withMessages([
                'input_validation' => 'Input validation must be a valid JSON object.',
            ]);
        }

        return $decoded;
    }
}
