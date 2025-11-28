@extends('admin.layouts.app')

@section('page_title', 'Add Chatbot Question')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Create Question</h1>
        <p class="text-muted">Define a new chatbot step (prompt + response type).</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.chatbot.questions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Questions
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.chatbot.questions.store') }}" method="POST">
            @csrf
            @include('admin.chatbot.questions.partials.form-fields', ['question' => null])

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Question
                </button>
                <a href="{{ route('admin.chatbot.questions.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
