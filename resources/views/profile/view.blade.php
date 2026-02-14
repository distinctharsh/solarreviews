@extends('layouts.app')

@section('content')
<div class="container-custom py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="bi bi-person-badge me-2"></i>
                    Profile Information
                </h2>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- User Information -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        User Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>User Type:</strong> 
                                @if($user->isDistributor())
                                    <span class="badge bg-success">Distributor</span>
                                @elseif($user->isManufacturer())
                                    <span class="badge bg-info">Manufacturer</span>
                                @else
                                    <span class="badge bg-secondary">{{ $user->userType->name ?? 'Unknown' }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> 
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-warning' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Submission Information -->
    @if($profileSubmission)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="bi bi-file-text me-2"></i>
                            Profile Submission Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Form Type:</strong> 
                                    <span class="badge bg-info">{{ $profileSubmission->form_type }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong> 
                                    <span class="badge {{ $profileSubmission->status === 'approved' ? 'bg-success' : ($profileSubmission->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ ucfirst($profileSubmission->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Submitted:</strong> {{ $profileSubmission->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Last Updated:</strong> {{ $profileSubmission->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>

                        @if($profileSubmission->payload)
                            <div class="mt-4">
                                <h6><strong>Submitted Information:</strong></h6>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            @foreach($profileSubmission->payload as $key => $value)
                                                <tr>
                                                    <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong></td>
                                                    <td>
                                                        @if(is_array($value))
                                                            {{ implode(', ', $value) }}
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if($profileSubmission->review_notes)
                            <div class="mt-4">
                                <h6><strong>Review Notes:</strong></h6>
                                <div class="alert alert-info">
                                    {{ $profileSubmission->review_notes }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <h5><i class="bi bi-exclamation-triangle me-2"></i> No Profile Submission Found</h5>
                    <p>You haven't submitted any profile information yet. Please complete your profile submission to get started.</p>
                    <div class="mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Complete Profile Submission
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Company Information (if approved) -->
    @if($company)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-building me-2"></i>
                            Company Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Company Name:</strong> {{ $company->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Phone:</strong> {{ $company->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Website:</strong> 
                                    @if($company->website_url)
                                        <a href="{{ $company->website_url }}" target="_blank">{{ $company->website_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Years in Business:</strong> {{ $company->years_in_business ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>GST Number:</strong> {{ $company->gst_number ?? 'N/A' }}</p>
                            </div>
                            <div class="col-12">
                                <p><strong>Description:</strong> {{ $company->description ?? 'N/A' }}</p>
                            </div>
                            <div class="col-12">
                                <p><strong>Address:</strong> {{ $company->address ?? 'N/A' }}</p>
                            </div>
                            @if($company->state || $company->city)
                                <div class="col-md-6">
                                    <p><strong>Location:</strong> 
                                        {{ $company->city ?? '' }}
                                        @if($company->state)
                                            , {{ $company->state->name ?? '' }}
                                        @endif
                                    </p>
                                </div>
                            @endif
                            @if($company->logo)
                                <div class="col-md-6">
                                    <p><strong>Logo:</strong></p>
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" class="img-fluid" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="container-custom py-4">
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
