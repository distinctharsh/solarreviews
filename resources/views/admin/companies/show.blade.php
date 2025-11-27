<!-- resources/views/admin/companies/show.blade.php -->
@extends('admin.layouts.app')

@section('page_title', 'Company Details')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Company: {{ $company->owner_name }}</h1>
        <p class="text-muted">View company details and information</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Company
        </a>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary ml-2">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Company Type</h6>
                        <p>{{ ucfirst($company->company_type) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Owner Name</h6>
                        <p>{{ $company->owner_name }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h6>Address</h6>
                    <p>{{ $company->address }}<br>
                    {{ $company->city }}, {{ $company->state }} - {{ $company->pincode }}</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Email</h6>
                        <p>{{ $company->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Phone</h6>
                        <p>{{ $company->phone }}</p>
                    </div>
                </div>

                @if($company->website_url)
                <div class="mb-4">
                    <h6>Website</h6>
                    <p><a href="{{ $company->website_url }}" target="_blank">{{ $company->website_url }}</a></p>
                </div>
                @endif

                @if($company->gst_number)
                <div class="mb-4">
                    <h6>GST Number</h6>
                    <p>{{ $company->gst_number }}</p>
                </div>
                @endif

                @if($company->description)
                <div class="mb-4">
                    <h6>Description</h6>
                    <p>{{ $company->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Status</h5>
            </div>
            <div class="card-body">
                <span class="badge badge-{{ $company->status === 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($company->status) }}
                </span>
            </div>
        </div>

        @if($company->logo_url)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Company Logo</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset($company->logo_url) }}" alt="Company Logo" class="img-fluid" style="max-height: 200px;">
            </div>
        </div>
        @endif
    </div>
</div>
@endsection