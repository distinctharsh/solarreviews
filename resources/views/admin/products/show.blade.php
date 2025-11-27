@extends('admin.layouts.app')

@section('page_title', 'Product Details')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Product: {{ $product->product_name }}</h1>
        <p class="text-muted">View product details and specifications</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Product
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary ml-2">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <h6>Brand</h6>
                        <p>{{ $product->brand->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Category</h6>
                        <p>{{ $product->category->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Type</h6>
                        <p>{{ $product->type ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <h6>Model Name</h6>
                        <p>{{ $product->model_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Capacity</h6>
                        <p>{{ $product->capacity_kw ? $product->capacity_kw . ' kW' : 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Size</h6>
                        <p>{{ $product->size ?? 'N/A' }}</p>
                    </div>
                </div>

                @if($product->warranty)
                <div class="mb-4">
                    <h6>Warranty</h6>
                    <p>{{ $product->warranty }}</p>
                </div>
                @endif

                @if($product->technical_details)
                <div class="mb-4">
                    <h6>Technical Details</h6>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($product->technical_details)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Specifications</h5>
            </div>
            <div class="card-body">
                @if($product->specs->count() > 0)
                    <table class="table table-sm">
                        <tbody>
                            @foreach($product->specs as $spec)
                                <tr>
                                    <th class="w-40">{{ $spec->spec_name }}</th>
                                    <td>{{ $spec->spec_value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No specifications added yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection