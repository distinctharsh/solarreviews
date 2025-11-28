@extends('admin.layouts.app')

@section('page_title', 'Chatbot Questions')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Chatbot Questions</h1>
        <p class="text-muted">Manage the scripted flow shown in the public chatbot assistant.</p>
    </div>
    <div class="content-header-right d-flex gap-2">
        <a href="{{ route('admin.chatbot.questions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Question
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($questions->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th width="160">Default Next</th>
                            <th width="120">Options</th>
                            <th width="100">Status</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>
                                    <strong>{{ $question->display_order }}</strong>
                                    <small class="d-block text-muted">ID: {{ $question->id }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $question->title }}</div>
                                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($question->prompt, 100) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark text-uppercase">{{ $question->type }}</span>
                                </td>
                                <td>
                                    @if($question->defaultNextQuestion)
                                        <span class="text-success"><i class="fas fa-arrow-right"></i> {{ $question->defaultNextQuestion->title }}</span>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>{{ $question->options()->count() }}</td>
                                <td>
                                    <span class="status-badge {{ $question->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $question->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.chatbot.questions.show', $question) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.chatbot.questions.edit', $question) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.chatbot.questions.destroy', $question) }}" class="d-inline" onsubmit="return confirm('Delete this question?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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

            <div class="pagination-wrapper">
                {{ $questions->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-robot"></i>
                <h3>No Questions Yet</h3>
                <p>Setup the first question to kick off the chatbot flow.</p>
                <a href="{{ route('admin.chatbot.questions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Question
                </a>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
}
.status-active {
    background: #dcfce7;
    color: #166534;
}
.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}
.empty-state i {
    font-size: 3rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}
.action-buttons {
    display: flex;
    gap: 0.35rem;
}
</style>
@endpush
@endsection
