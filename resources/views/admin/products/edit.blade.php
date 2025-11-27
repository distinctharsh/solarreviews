{{-- resources/views/admin/products/edit.blade.php --}}
@extends('admin.layouts.app')

@section('page_title', 'Edit Product: ' . $product->product_name)

@section('content')
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.products._form', [
        'product' => $product,
        'brands' => $brands,
        'categories' => $categories,
        'types' => $types
    ])
</form>
@endsection