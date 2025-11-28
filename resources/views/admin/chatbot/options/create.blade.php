@extends('admin.layouts.app')

@section('page_title', 'Add Option')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Add Option</h1>
        <p class="text-muted">Attach a selectable answer to "{{ $question->title }}".</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.chatbot.questions.show', $question) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Question
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.chatbot.questions.options.store', $question) }}" method="POST">
            @csrf

            @include('admin.chatbot.options.partials.form-fields', ['option' => null])

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Option
                </button>
                <a href="{{ route('admin.chatbot.questions.show', $question) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
