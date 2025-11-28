<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatbotOptionController extends Controller
{
    public function create(ChatbotQuestion $question): View
    {
        $otherQuestions = ChatbotQuestion::where('id', '!=', $question->id)
            ->ordered()
            ->pluck('title', 'id');

        return view('admin.chatbot.options.create', compact('question', 'otherQuestions'));
    }

    public function store(Request $request, ChatbotQuestion $question): RedirectResponse
    {
        $validated = $this->validateOption($request);
        $validated['question_id'] = $question->id;

        $option = ChatbotOption::create($validated);

        return redirect()
            ->route('admin.chatbot.questions.show', $question)
            ->with('success', 'Option created successfully.');
    }

    public function edit(ChatbotQuestion $question, ChatbotOption $option): View
    {
        $otherQuestions = ChatbotQuestion::where('id', '!=', $question->id)
            ->ordered()
            ->pluck('title', 'id');

        return view('admin.chatbot.options.edit', compact('question', 'option', 'otherQuestions'));
    }

    public function update(Request $request, ChatbotQuestion $question, ChatbotOption $option): RedirectResponse
    {
        $validated = $this->validateOption($request);
        $option->update($validated);

        return redirect()
            ->route('admin.chatbot.questions.show', $question)
            ->with('success', 'Option updated successfully.');
    }

    public function destroy(ChatbotQuestion $question, ChatbotOption $option): RedirectResponse
    {
        $option->delete();

        return redirect()
            ->route('admin.chatbot.questions.show', $question)
            ->with('success', 'Option deleted successfully.');
    }

    protected function validateOption(Request $request): array
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'next_question_id' => 'nullable|exists:chatbot_questions,id',
            'metadata' => 'nullable',
        ]);

        $validated['display_order'] = $validated['display_order'] ?? 0;
        $validated['metadata'] = $this->parseMetadata($validated['metadata'] ?? null);

        return $validated;
    }

    protected function parseMetadata(?string $raw): ?array
    {
        if ($raw === null || $raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            return null;
        }

        return $decoded;
    }
}
