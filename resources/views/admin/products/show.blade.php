<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit Product') }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Back to Products') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Product Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex">
                        <!-- Product Image -->
                        <div class="md:w-1/3">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="md:w-2/3 md:pl-8 mt-6 md:mt-0">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                                <div class="flex space-x-2">
                                    @if($product->is_active)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                    
                                    @if($product->is_featured)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ __('Featured') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-2 text-sm text-gray-600">
                                <span class="font-medium">{{ __('Category') }}:</span> {{ $product->category->name ?? 'N/A' }}
                            </div>
                            
                            @if($product->manufacturer)
                                <div class="mt-1 text-sm text-gray-600">
                                    <span class="font-medium">{{ __('Manufacturer') }}:</span> {{ $product->manufacturer }}
                                </div>
                            @endif
                            
                            @if($product->model_number)
                                <div class="mt-1 text-sm text-gray-600">
                                    <span class="font-medium">{{ __('Model Number') }}:</span> {{ $product->model_number }}
                                </div>
                            @endif
                            
                            @if($product->warranty_years)
                                <div class="mt-1 text-sm text-gray-600">
                                    <span class="font-medium">{{ __('Warranty') }}:</span> {{ $product->warranty_years }} {{ __('years') }}
                                </div>
                            @endif
                            
                            <div class="mt-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Description') }}</h3>
                                <div class="mt-2 prose max-w-none text-gray-600">
                                    {!! nl2br(e($product->description ?? 'No description available.')) !!}
                                </div>
                            </div>
                            
                            @if($product->features && count($product->features) > 0)
                                <div class="mt-6">
                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Features') }}</h3>
                                    <ul class="mt-2 list-disc pl-5 space-y-1">
                                        @foreach($product->features as $feature)
                                            <li class="text-gray-600">{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Variants -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Product Variants') }}</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('State') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Price') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Sale Price') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Stock') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('SKU') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($product->variants as $variant)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $variant->state->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ${{ number_format($variant->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($variant->sale_price && $variant->sale_start_date <= now() && $variant->sale_end_date >= now())
                                                <span class="text-green-600 font-medium">${{ number_format($variant->sale_price, 2) }}</span>
                                                <span class="text-xs text-gray-500">({{ __('Sale') }})</span>
                                            @elseif($variant->sale_price)
                                                <span class="text-gray-400 line-through">${{ number_format($variant->sale_price, 2) }}</span>
                                                <span class="text-xs text-gray-500">({{ __('Not active') }})</span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $variant->stock_quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $variant->sku ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            {{ __('No variants found for this product.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($product->variants->isNotEmpty())
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-900 mb-2">{{ __('Dimensions') }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Weight') }}</div>
                                    <div class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $product->variants->first()->weight ? $product->variants->first()->weight . ' kg' : '-' }}
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Length') }}</div>
                                    <div class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $product->variants->first()->length ? $product->variants->first()->length . ' cm' : '-' }}
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Width') }}</div>
                                    <div class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $product->variants->first()->width ? $product->variants->first()->width . ' cm' : '-' }}
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Height') }}</div>
                                    <div class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $product->variants->first()->height ? $product->variants->first()->height . ' cm' : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Reviews -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Reviews') }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $product->reviews->count() }} {{ __('Reviews') }}
                        </span>
                    </div>
                    
                    @if($product->reviews->isNotEmpty())
                        <div class="space-y-6">
                            @foreach($product->reviews as $review)
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">{{ $review->title }}</p>
                                                <p class="text-sm text-gray-500">{{ $review->author_name }} - {{ $review->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $review->status === 'approved' ? 'bg-green-100 text-green-800' : ($review->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($review->status) }}
                                        </span>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        {{ $review->content }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No reviews yet') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ __('Be the first to review this product.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('styles')
<style>
    /* Product details styles */
    .product-image {
        max-height: 400px;
        object-fit: contain;
    }
    
    /* Review stars */
    .review-rating {
        color: #f59e0b;
    }
    
    /* Status badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    /* Variant table */
    .variant-table {
        min-width: 100%;
        border-collapse: collapse;
    }
    
    .variant-table th, 
    .variant-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .variant-table th {
        background-color: #f9fafb;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .variant-table {
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>
@endpush
