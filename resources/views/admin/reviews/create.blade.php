<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Review') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Company Selection -->
                            <div>
                                <label for="company_id" class="block text-sm font-medium text-gray-700">Company</label>
                                <select id="company_id" name="company_id" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Reviewer Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="reviewer_name" class="block text-sm font-medium text-gray-700">Reviewer Name</label>
                                    <input type="text" id="reviewer_name" name="reviewer_name" 
                                           value="{{ old('reviewer_name') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required autofocus>
                                    @error('reviewer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" 
                                                    class="text-3xl focus:outline-none star-rating"
                                                    data-rating="{{ $i }}">
                                                @if(old('rating', 5) >= $i)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            </button>
                                        @endfor
                                        <input type="hidden" name="rating" id="rating" value="{{ old('rating', 5) }}">
                                    </div>
                                    @error('rating')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Review Date & Source -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="review_date" class="block text-sm font-medium text-gray-700">Review Date</label>
                                    <input type="date" id="review_date" name="review_date" 
                                           value="{{ old('review_date', now()->format('Y-m-d')) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required>
                                    @error('review_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="source" class="block text-sm font-medium text-gray-700">Source</label>
                                    <input type="text" id="source" name="source" 
                                           value="{{ old('source') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required>
                                    @error('source')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="is_featured" name="is_featured" 
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured Review</label>
                            </div>

                            <!-- Review Text -->
                            <div>
                                <label for="review_text" class="block text-sm font-medium text-gray-700">Review</label>
                                <textarea id="review_text" name="review_text" rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>{{ old('review_text') }}</textarea>
                                @error('review_text')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
                            <a href="{{ route('admin.reviews.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .star-rating {
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 2px;
        }
        .star-rating:hover,
        .star-rating.active,
        .star-rating:hover ~ .star-rating {
            color: #f59e0b;
        }
        [data-rating] {
            font-size: 2rem;
            line-height: 1;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating');
            const ratingInput = document.getElementById('rating');
            
            function initializeStars() {
                const currentRating = parseInt(ratingInput.value) || 0;
                stars.forEach((star, index) => {
                    if (index < currentRating) {
                        star.textContent = '★';
                        star.classList.add('active');
                    } else {
                        star.textContent = '☆';
                        star.classList.remove('active');
                    }
                });
            }
            
            initializeStars();
            
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    ratingInput.value = rating;
                    
                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.textContent = '★';
                            s.classList.add('active');
                        } else {
                            s.textContent = '☆';
                            s.classList.remove('active');
                        }
                    });
                });
                
                star.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.getAttribute('data-rating'));
                    stars.forEach((s, index) => {
                        s.textContent = index < hoverRating ? '★' : '☆';
                    });
                });
                
                star.addEventListener('mouseout', initializeStars);
            });
        });
    </script>
    @endpush
</x-app-layout>
