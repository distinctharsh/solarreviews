@extends('admin.layouts.app')

@section('page_title', 'Reviews')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Reviews</h1>
        <p class="text-muted">Manage product and company reviews (Coming soon)</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <i class="fas fa-star"></i>
            <h3>Reviews Management Coming Soon</h3>
            <p>First complete the full setup: Categories → Brands → Companies → Products.</p>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Go to Categories
            </a>
        </div>
    </div>
</div>

<style>
.empty-state {
    text-align: center;
    padding: 3rem;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #475569;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #94a3b8;
    margin-bottom: 1.5rem;
}
</style>
@endsection
