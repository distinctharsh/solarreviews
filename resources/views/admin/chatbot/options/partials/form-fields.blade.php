<div class="form-grid">
    <div class="form-group">
        <label for="label" class="form-label">Option Label <span class="required">*</span></label>
        <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @enderror"
               value="{{ old('label', $option->label ?? '') }}" placeholder="e.g., Panel Issue" required>
        @error('label')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="value" class="form-label">Value (optional)</label>
        <input type="text" name="value" id="value" class="form-control @error('value') is-invalid @enderror"
               value="{{ old('value', $option->value ?? '') }}" placeholder="slug or internal value">
        @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="description" class="form-label">Description / Tooltip</label>
    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror"
              placeholder="Additional context shown under the option button">{{ old('description', $option->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-grid">
    <div class="form-group">
        <label for="display_order" class="form-label">Display Order</label>
        <input type="number" name="display_order" id="display_order" min="0"
               class="form-control @error('display_order') is-invalid @enderror"
               value="{{ old('display_order', $option->display_order ?? 0) }}">
        <small class="form-text text-muted">Lower numbers appear first</small>
        @error('display_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="next_question_id" class="form-label">Next Question</label>
        <select name="next_question_id" id="next_question_id" class="form-control @error('next_question_id') is-invalid @enderror">
            <option value="">— Use Default —</option>
            @foreach($otherQuestions as $id => $title)
                <option value="{{ $id }}" {{ (string) old('next_question_id', $option->next_question_id ?? '') === (string) $id ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">Overrides default flow when selected</small>
        @error('next_question_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="metadata" class="form-label">Metadata (JSON)</label>
    <textarea name="metadata" id="metadata" rows="3" class="form-control @error('metadata') is-invalid @enderror"
              placeholder='{"tag": "support"}'>{{ old('metadata', isset($option) && $option->metadata ? json_encode($option->metadata, JSON_PRETTY_PRINT) : '') }}</textarea>
    <small class="form-text text-muted">Optional payload (tags, severity, etc.)</small>
    @error('metadata')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
