@php
    $questionTypes = [
        'choice' => 'Multiple Choice',
        'input' => 'Short Input',
        'text' => 'Paragraph Input',
        'number' => 'Number',
        'email' => 'Email',
        'phone' => 'Phone'
    ];
@endphp

<div class="form-grid">
    <div class="form-group">
        <label for="title" class="form-label">Title <span class="required">*</span></label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $question->title ?? '') }}" placeholder="Welcome Question" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="type" class="form-label">Response Type <span class="required">*</span></label>
        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
            @foreach($questionTypes as $value => $label)
                <option value="{{ $value }}" {{ old('type', $question->type ?? 'choice') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="prompt" class="form-label">Prompt / Message <span class="required">*</span></label>
    <textarea name="prompt" id="prompt" rows="4" class="form-control @error('prompt') is-invalid @enderror"
              placeholder="Hi! What can we help you with?" required>{{ old('prompt', $question->prompt ?? '') }}</textarea>
    @error('prompt')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-grid">
    <div class="form-group">
        <label for="display_order" class="form-label">Display Order</label>
        <input type="number" name="display_order" id="display_order" min="0"
               class="form-control @error('display_order') is-invalid @enderror"
               value="{{ old('display_order', $question->display_order ?? 0) }}">
        <small class="form-text text-muted">Lower numbers appear first</small>
        @error('display_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="default_next_question_id" class="form-label">Default Next Question</label>
        <select name="default_next_question_id" id="default_next_question_id"
                class="form-control @error('default_next_question_id') is-invalid @enderror">
            <option value="">— None —</option>
            @foreach($otherQuestions as $id => $title)
                <option value="{{ $id }}" {{ (string) old('default_next_question_id', $question->default_next_question_id ?? '') === (string) $id ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">Used when no option-specific jump exists</small>
        @error('default_next_question_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-grid">
    <div class="form-group">
        <label for="input_placeholder" class="form-label">Input Placeholder</label>
        <input type="text" name="input_placeholder" id="input_placeholder"
               class="form-control @error('input_placeholder') is-invalid @enderror"
               value="{{ old('input_placeholder', $question->input_placeholder ?? '') }}">
        @error('input_placeholder')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="input_validation" class="form-label">Input Validation (JSON)</label>
        <textarea name="input_validation" id="input_validation"
                  class="form-control @error('input_validation') is-invalid @enderror"
                  rows="3" placeholder='{"min":1,"max":200}'>{!! old('input_validation', isset($question) && $question->input_validation ? json_encode($question->input_validation, JSON_PRETTY_PRINT) : '') !!}</textarea>
        <small class="form-text text-muted">Optional JSON rules (min, max, regex, etc.)</small>
        @error('input_validation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Required?</label>
        <div class="form-check">
            <input type="checkbox" name="is_required" id="is_required" value="1" class="form-check-input"
                   {{ old('is_required', $question->is_required ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_required">User must answer to continue</label>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Active?</label>
        <div class="form-check">
            <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input"
                   {{ old('is_active', $question->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Visible in chatbot</label>
        </div>
    </div>
</div>
