@extends('admin.layouts.app')

@section('page_title', 'Chatbot Question Detail')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>{{ $question->title }}</h1>
        <p class="text-muted">Question ID #{{ $question->id }} · {{ ucfirst($question->type) }} type</p>
    </div>
    <div class="content-header-right d-flex gap-2">
        <a href="{{ route('admin.chatbot.questions.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Questions
        </a>
        <a href="{{ route('admin.chatbot.questions.edit', $question) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Question
        </a>
        <form action="{{ route('admin.chatbot.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Delete this question and its options?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Prompt & Settings</h5>
                <div class="mb-3">
                    <label class="text-muted fw-semibold">Prompt</label>
                    <p class="mb-0">{{ $question->prompt }}</p>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <label class="text-muted d-block">Type</label>
                        <span class="badge bg-light text-dark text-uppercase">{{ $question->type }}</span>
                    </div>
                    <div>
                        <label class="text-muted d-block">Required</label>
                        <span class="status-badge {{ $question->is_required ? 'status-active' : 'status-inactive' }}">
                            {{ $question->is_required ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div>
                        <label class="text-muted d-block">Active</label>
                        <span class="status-badge {{ $question->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $question->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-muted fw-semibold">Default Next Question</label>
                    <p class="mb-0">
                        @if($question->defaultNextQuestion)
                            <i class="fas fa-arrow-right text-success"></i> {{ $question->defaultNextQuestion->title }}
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="text-muted fw-semibold">Input Placeholder</label>
                    <p class="mb-0">{{ $question->input_placeholder ?: '—' }}</p>
                </div>
                <div>
                    <label class="text-muted fw-semibold">Input Validation JSON</label>
                    <pre class="bg-light p-3 rounded small mb-0">{{ $question->input_validation ? json_encode($question->input_validation, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 'None' }}</pre>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Meta</h5>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Display Order</span>
                        <span class="fw-semibold">{{ $question->display_order }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Created</span>
                        <span>{{ $question->created_at?->format('d M Y, h:i A') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Updated</span>
                        <span>{{ $question->updated_at?->format('d M Y, h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="card-title mb-0">Options</h5>
                <small class="text-muted">Define the button/options shown for this question.</small>
            </div>
            <a href="{{ route('admin.chatbot.questions.options.create', $question) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Option
            </a>
        </div>

        @if($question->options->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="70">Order</th>
                            <th>Label</th>
                            <th>Value</th>
                            <th>Description</th>
                            <th width="200">Next Question</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($question->options as $option)
                            <tr>
                                <td>{{ $option->display_order }}</td>
                                <td class="fw-semibold">{{ $option->label }}</td>
                                <td>{{ $option->value ?: '—' }}</td>
                                <td>{{ $option->description ? \Illuminate\Support\Str::limit($option->description, 100) : '—' }}</td>
                                <td>
                                    @if($option->nextQuestion)
                                        <span class="text-success"><i class="fas fa-arrow-turn-down"></i> {{ $option->nextQuestion->title }}</span>
                                    @else
                                        <span class="text-muted">Uses default</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.chatbot.questions.options.edit', [$question, $option]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.chatbot.questions.options.destroy', [$question, $option]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this option?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-list"></i>
                <h4>No Options Available</h4>
                <p>Add at least one option or configure default next question for this step.</p>
                <a href="{{ route('admin.chatbot.questions.options.create', $question) }}" class="btn btn-primary">Add Option</a>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.status-badge {
    padding: 0.2rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
}
.status-active { background: #dcfce7; color: #166534; }
.status-inactive { background: #fee2e2; color: #991b1b; }
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-state i { font-size: 3rem; color: #cbd5e1; margin-bottom: 0.5rem; }
.action-buttons { display: flex; gap: 0.35rem; }
pre { white-space: pre-wrap; }
</style>
@endpush
@endsection
