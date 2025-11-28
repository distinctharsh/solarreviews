@extends('admin.layouts.app')

@section('page_title', 'Chatbot Conversation Logs')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Conversation Logs</h1>
        <p class="text-muted">Review what users discussed with the chatbot.</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.chatbot.reports.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="search" class="form-label">Search (UUID / Source)</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Visitor UUID or source">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">All</option>
                    @foreach($statusOptions as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('admin.chatbot.reports.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($sessions->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Visitor UUID</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Messages</th>
                            <th>Started</th>
                            <th>Ended</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->id }}</td>
                                <td>{{ $session->visitor_uuid ?? '—' }}</td>
                                <td>{{ $session->source ?? '—' }}</td>
                                <td><span class="badge bg-light text-dark text-uppercase">{{ $session->status }}</span></td>
                                <td>{{ $session->messages_count }}</td>
                                <td>{{ optional($session->started_at)->format('d M Y, h:i A') ?: '—' }}</td>
                                <td>{{ optional($session->ended_at)->format('d M Y, h:i A') ?: '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.chatbot.reports.show', $session) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $sessions->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-comments"></i>
                <h3>No Sessions Yet</h3>
                <p>Once users start interacting with the chatbot, their conversations will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
