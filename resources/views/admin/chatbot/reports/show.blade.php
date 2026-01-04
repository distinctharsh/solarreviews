@extends('admin.layouts.app')

@section('page_title', 'Conversation Detail')

@section('content')
<div class="content-header">
    <!-- <div class="content-header-left">
        <h1>Conversation #{{ $session->id }}</h1>
        <p class="text-muted">Visitor {{ $session->visitor_uuid ?? 'Anonymous' }} · {{ ucfirst($session->status) }}</p>
    </div> -->
    <div class="content-header-right">
        <a href="{{ route('admin.chatbot.reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Logs
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Conversation Chat</h5>
                @php
                    $transcript = data_get($session->context, 'transcript', []);
                    $transcriptCount = is_array($transcript) ? count($transcript) : 0;
                @endphp

                @if($transcriptCount)
                    <div class="chat-log">
                        @foreach($transcript as $entry)
                            @php
                                $sender = $entry['sender'] ?? 'user';
                                $payload = $entry['payload'] ?? [];
                                $time = $entry['at'] ?? null;
                                $botPrompt = data_get($payload, 'question.prompt');
                                $selectedLabel = data_get($payload, 'answer.option_label');
                                $selectedValue = data_get($payload, 'answer.option_value');
                                $inputValue = data_get($payload, 'answer.input_value');
                            @endphp

                            <div class="chat-entry {{ $sender === 'bot' ? 'bot' : 'user' }}">
                                <div class="chat-meta">
                                    <span class="chat-sender">{{ ucfirst($sender) }}</span>
                                    <span class="chat-time">{{ $time ? \Carbon\Carbon::parse($time)->format('d M Y, h:i A') : '—' }}</span>
                                </div>
                                <div class="chat-content">
                                    @if($sender === 'bot')
                                        <p class="mb-0">{{ $botPrompt ?: '—' }}</p>
                                    @else
                                        @if($selectedLabel || $selectedValue)
                                            <p class="mb-1"><strong>Selected:</strong> {{ $selectedLabel ?: $selectedValue }}</p>
                                        @endif
                                        @if($inputValue)
                                            <p class="mb-0"><strong>Input:</strong> {{ $inputValue }}</p>
                                        @endif

                                        @if(!($selectedLabel || $selectedValue || $inputValue))
                                            <p class="mb-0">—</p>
                                        @endif
                                    @endif

                                    <!-- @if(!empty($payload))
                                        <details class="payload-details mt-2">
                                            <summary class="payload-summary">View raw payload</summary>
                                            <pre class="bg-white border rounded small p-2 mt-2 mb-0">{{ json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                        </details>
                                    @endif -->
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

.payload-details {
    user-select: text;
}

.payload-summary {
    cursor: pointer;
    color: #475569;
    font-size: 0.85rem;
}
</style>
@endpush
@endsection
