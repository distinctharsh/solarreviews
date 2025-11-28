<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotUserSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatbotReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = ChatbotUserSession::query()
            ->withCount('messages')
            ->latest('started_at')
            ->latest();

        if ($status = $request->string('status')->trim()->toString()) {
            $query->where('status', $status);
        }

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('visitor_uuid', 'like', "%{$search}%")
                    ->orWhere('source', 'like', "%{$search}%");
            });
        }

        $sessions = $query->paginate(20)->withQueryString();

        $statusOptions = ChatbotUserSession::query()
            ->select('status')
            ->distinct()
            ->pluck('status');

        return view('admin.chatbot.reports.index', compact('sessions', 'statusOptions'));
    }

    public function show(ChatbotUserSession $session): View
    {
        $session->load(['messages.question', 'messages.option'])
            ->loadCount('messages');

        return view('admin.chatbot.reports.show', compact('session'));
    }
}
