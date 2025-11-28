@extends('admin.layouts.app')

@section('page_title', 'Conversation Detail')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Conversation #{{ $session->id }}</h1>
        <p class="text-muted">Visitor {{ $session->visitor_uuid ?? 'Anonymous' }} · {{ ucfirst($session->status) }}</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.chatbot.reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Logs
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Session Summary</h5>
                <dl class="row">
                    <dt class="col-5">Visitor UUID</dt>
                    <dd class="col-7">{{ $session->visitor_uuid ?? '—' }}</dd>

                    <dt class="col-5">Source</dt>
                    <dd class="col-7">{{ $session->source ?? '—' }}</dd>

                    <dt class="col-5">Status</dt>
                    <dd class="col-7"><span class="badge bg-light text-dark">{{ ucfirst($session->status) }}</span></dd>

                    <dt class="col-5">Messages</dt>
                    <dd class="col-7">{{ $session->messages_count }}</dd>

                    <dt class="col-5">Started</dt>
                    <dd class="col-7">{{ optional($session->started_at)->format('d M Y, h:i A') ?: '—' }}</dd>

                    <dt class="col-5">Ended</dt>
                    <dd class="col-7">{{ optional($session->ended_at)->format('d M Y, h:i A') ?: '—' }}</dd>
                </dl>

                @if($session->context)
                    <h6 class="mt-4">Context</h6>
                    <pre class="bg-light p-3 rounded small">{{ json_encode($session->context, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Conversation Transcript</h5>
                @if($session->messages->count())
                    <div class="chat-log">
                        @foreach($session->messages as $message)
                            <div class="chat-entry {{ $message->sender === 'bot' ? 'bot' : 'user' }}">
                                <div class="chat-meta">
                                    <span class="chat-sender">{{ ucfirst($message->sender) }}</span>
                                    <span class="chat-time">{{ $message->created_at?->format('d M Y, h:i A') }}</span>
                                </div>
                                <div class="chat-content">
                                    @if($message->sender === 'bot')
                                        <p class="mb-1">{{ $message->question?->prompt }}</p>
                                    @else
                                        @if($message->option)
                                            <p class="mb-1"><strong>Selected:</strong> {{ $message->option->label }}</p>
                                        @endif
                                        @if($message->input_value)
                                            <p class="mb-0"><strong>Input:</strong> {{ $message->input_value }}</p>
                                        @endif
                                    @endif
                                    @if($message->payload)
                                        <pre class="bg-white border rounded small p-2 mt-2">{{ json_encode($message->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-comment-slash"></i>
                        <p>No messages recorded for this session yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.chat-log {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-height: 70vh;
    overflow-y: auto;
    padding-right: 0.5rem;
}
.chat-entry {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
}
.chat-entry.user {
    background: #ecfdf5;
    border-color: #bbf7d0;
}
.chat-entry.bot {
    background: #eff6ff;
    border-color: #bfdbfe;
}
.chat-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: #64748b;
    margin-bottom: 0.5rem;
}
.chat-sender {
    font-weight: 600;
}
pre {
    white-space: pre-wrap;
}
</style>
@endpush
@endsection
