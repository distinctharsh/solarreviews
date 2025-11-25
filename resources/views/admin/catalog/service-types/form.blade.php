@extends('admin.layouts.app')

@section('page_title', $title)

@push('styles')
<style>
    .form-card {
        max-width: 720px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        padding: 24px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 6px;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid #cbd5f5;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
    }

    .switch {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn-primary {
        background: #14b8a6;
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-link {
        text-decoration: none;
        color: #64748b;
    }
</style>
@endpush

@section('content')
<div class="form-card">
    <form action="{{ $route }}" method="POST">
        @csrf
        @method($method)

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required>
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug (optional)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug) }}">
            <small class="text-slate-500">Leave blank to auto-generate.</small>
            @error('slug')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="service_group">Service group</label>
            <input type="text" name="service_group" id="service_group" value="{{ old('service_group', $service->service_group) }}">
            <small class="text-slate-500">Optional grouping (e.g., solar-epc, after-sales, hybrid).</small>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group">
            <label class="switch">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                <span>Active</span>
            </label>
        </div>

        <div class="actions">
            <a href="{{ route('admin.catalog.service-types.index') }}" class="btn-link">Cancel</a>
            <button type="submit" class="btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
