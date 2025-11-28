@extends('admin.layouts.app')

@section('page_title', 'Edit Chatbot Question')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Edit Question</h1>
        <p class="text-muted">Update prompt, response type, or default flow.</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.chatbot.questions.show', $question) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Question Detail
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.chatbot.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.chatbot.questions.partials.form-fields', ['question' => $question])

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('admin.chatbot.questions.show', $question) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
