<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
 

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Quick Actions -->
                <div class="mb-6">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.companies.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m4 0h4m-4-4h4m-4-4h4m-4-4h4" />
                            </svg>
                            Add Company
                        </a>
                        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Add Product
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Companies -->
                    <a href="{{ route('admin.companies.index') }}" class="block hover:opacity-90 transition-opacity">
                        <div class="p-5 bg-white rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m4 0h4m-4-4h4m-4-4h4m-4-4h4" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500">Total Companies</p>
                                    <p class="text-2xl font-semibold text-gray-700">{{ $stats['total_companies'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Total Products -->
                    <a href="{{ route('admin.products.index') }}" class="block hover:opacity-90 transition-opacity">
                        <div class="p-5 bg-white rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500">Total Products</p>
                                    <p class="text-2xl font-semibold text-gray-700">{{ $stats['total_products'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Total Reviews -->
                    <!-- <a href="{{ route('admin.reviews.index') }}" class="block hover:opacity-90 transition-opacity">
                        <div class="p-5 bg-white rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500">Total Reviews</p>
                                    <p class="text-2xl font-semibold text-gray-700">{{ $stats['total_reviews'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </a> -->

                    <!-- Total Users -->
                    <div class="p-5 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Recent Reviews -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Recent Reviews</h3>
                            <a href="{{ route('admin.reviews.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($recentReviews as $review)
                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review['rating'])
                                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $review['reviewer_name'] }}
                                                <span class="text-xs text-gray-500 ml-2">
                                                    {{ \Carbon\Carbon::parse($review['created_at'])->diffForHumans() }}
                                                </span>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                {{ Str::limit($review['review_text'], 100) }}
                                            </p>
                                            <div class="mt-1 text-xs text-gray-500">
                                                @if($review['company'])
                                                    <a href="{{ route('admin.companies.edit', $review['company']['id']) }}" class="text-blue-600 hover:text-blue-800">
                                                        {{ $review['company']['name'] }}
                                                    </a>
                                                @endif
                                                @if(!empty($review['category']))
                                                    <span class="mx-1">•</span>
                                                    <span class="text-gray-600">
                                                        {{ $review['category']['name'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ route('admin.reviews.edit', $review['id']) }}" class="text-gray-400 hover:text-gray-500">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500">
                                    No reviews found.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Top Companies -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Top Companies</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($topCompanies as $company)
                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            @if($company['logo'])
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $company['logo'] }}" alt="{{ $company['name'] }}">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                <a href="{{ route('admin.companies.edit', $company['id']) }}" class="hover:text-blue-600">
                                                    {{ $company['name'] }}
                                                </a>
                                            </p>
                                            <div class="flex items-center mt-1">
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $company['reviews_avg_rating'])
                                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-1 text-xs text-gray-500">({{ $company['reviews_count'] }})</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ route('admin.companies.edit', $company['id']) }}" class="text-gray-400 hover:text-gray-500">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500">
                                    No companies found.
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-4 bg-gray-50 text-right">
                            <a href="{{ route('admin.companies.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all companies
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Top Products -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Top Rated Products</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($topProducts as $product)
                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-4">
                                            @if($product->image)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center text-gray-500">
                                                    {{ substr($product->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-medium text-gray-900 hover:text-green-600">
                                                {{ $product->name }}
                                            </a>
                                            <div class="flex items-center mt-1">
                                                <div class="flex items-center">
                                                    @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $rating)
                                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-2 text-xs text-gray-500">
                                                        {{ number_format($rating, 1) }} ({{ $product->reviews_count }} reviews)
                                                    </span>
                                                </div>
                                            </div>
                                            @if($product->company)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <a href="{{ route('admin.companies.edit', $product->company) }}" class="text-blue-600 hover:text-blue-800">
                                                        {{ $product->company->name }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500">
                                    No products found.
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-4 bg-gray-50 text-right">
                            <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all products
                            </a>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Recent Users</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($recentUsers as $user)
                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $user['name'] }}
                                                @if($user['is_admin'])
                                                    <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Admin
                                                    </span>
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $user['email'] }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Joined {{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500">
                                    No users found.
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-4 bg-gray-50 text-right">
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all users
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
