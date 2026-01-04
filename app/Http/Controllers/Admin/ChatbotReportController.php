<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotUserSession;
use App\Models\NormalUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatbotReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = ChatbotUserSession::query()
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

        $userIds = $sessions->pluck('user_id')->filter()->unique()->values();
        $businessUsers = $userIds->isNotEmpty()
            ? User::query()->whereIn('id', $userIds)->pluck('name', 'id')
            : collect();
        $normalUsers = $userIds->isNotEmpty()
            ? NormalUser::query()->whereIn('id', $userIds)->pluck('name', 'id')
            : collect();

        $userNames = $userIds->mapWithKeys(function ($id) use ($businessUsers, $normalUsers) {
            $name = $businessUsers->get($id) ?? $normalUsers->get($id);

            return [$id => $name ?: 'Guest User'];
        });

        $statusOptions = ChatbotUserSession::query()
            ->select('status')
            ->distinct()
            ->pluck('status');

        return view('admin.chatbot.reports.index', compact('sessions', 'statusOptions', 'userNames'));
    }

    public function show(ChatbotUserSession $report): View
    {
        $session = $report->load(['messages.question', 'messages.option'])
            ->loadCount('messages');

        return view('admin.chatbot.reports.show', compact('session'));
    }
}
