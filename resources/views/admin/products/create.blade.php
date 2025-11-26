<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('admin.products.form', [
                    'product' => $product ?? null,
                    'companies' => $companies,
                    'brands' => $brands,
                    'categories' => $categories,
                ])
            </div>
        </div>
    </div>
</x-admin-layout>

@push('styles')
<style>
    /* Add any custom styles here */
    .variant-item {
        background-color: #f9fafb;
        border-left: 3px solid #4f46e5;
    }
    
    .variant-item h4 {
        color: #374151;
    }
    
    /* Style for required fields */
    .required:after {
        content: ' *';
        color: #ef4444;
    }
    
    /* Style for form sections */
    .form-section {
        margin-bottom: 2rem;
    }
    
    .form-section-title {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    /* Style for form groups */
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    /* Style for form labels */
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    /* Style for form inputs */
    .form-input {
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        color: #111827;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-input:focus {
        border-color: #818cf8;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
    }
    
    /* Style for error messages */
    .error-message {
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: #ef4444;
    }
    
    /* Style for buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        font-size: 0.875rem;
        line-height: 1.5;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
    }
    
    .btn-primary {
        background-color: #4f46e5;
        color: white;
        border: 1px solid transparent;
    }
    
    .btn-primary:hover {
        background-color: #4338ca;
    }
    
    .btn-secondary {
        background-color: #e5e7eb;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary:hover {
        background-color: #d1d5db;
    }
    
    /* Style for file input */
    .file-input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    
    .file-input-label {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #f3f4f6;
        color: #374151;
        border-radius: 0.375rem;
        border: 1px dashed #d1d5db;
        cursor: pointer;
        transition: all 0.15s ease-in-out;
    }
    
    .file-input-label:hover {
        background-color: #e5e7eb;
        border-color: #9ca3af;
    }
    
    /* Style for preview image */
    .image-preview {
        margin-top: 0.5rem;
        max-width: 200px;
        max-height: 200px;
        border-radius: 0.375rem;
        border: 1px solid #e5e7eb;
    }
</style>
@endpush
