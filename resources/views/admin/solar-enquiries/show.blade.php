@extends('admin.layouts.app')

@section('page_title', 'Solar Enquiry Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="card-title mb-1">Solar Enquiry Details</h2>
                    <p class="text-muted small mb-0">Submitted on {{ $enquiry->created_at?->format('d M Y, h:i A') }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.solar-enquiries.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Enquiries
                    </a>
                    <form method="POST" action="{{ route('admin.solar-enquiries.destroy', $enquiry) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this enquiry?')">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Customer Information</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="150"><strong>Name:</strong></td>
                            <td>{{ $enquiry->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mobile Number:</strong></td>
                            <td>{{ $enquiry->mobile_number }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $enquiry->email ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td><strong>IP Address:</strong></td>
                            <td>{{ $enquiry->ip_address ?: '—' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Project Details</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="150"><strong>Category:</strong></td>
                            <td><span class="badge bg-light text-dark">{{ $enquiry->category }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td class="text-capitalize">{{ $enquiry->type }}</td>
                        </tr>
                        @if($enquiry->capacity)
                            <tr>
                                <td><strong>Capacity:</strong></td>
                                <td>{{ $enquiry->capacity }} KW</td>
                            </tr>
                        @endif
                        @if($enquiry->net_metering)
                            <tr>
                                <td><strong>Net Metering:</strong></td>
                                <td>{{ $enquiry->net_metering }}</td>
                            </tr>
                        @endif
                        @if($enquiry->tin_shed_age)
                            <tr>
                                <td><strong>Tin Shed Age:</strong></td>
                                <td>{{ $enquiry->tin_shed_age }} years</td>
                            </tr>
                        @endif
                        @if($enquiry->distance_from_substation)
                            <tr>
                                <td><strong>Distance from Substation:</strong></td>
                                <td>{{ $enquiry->distance_from_substation }} Kms</td>
                            </tr>
                        @endif
                        @if($enquiry->line)
                            <tr>
                                <td><strong>Line:</strong></td>
                                <td>{{ $enquiry->line }} KV</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Location Information</h5>
                    @if($enquiry->use_location === 'dropdown')
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td width="150"><strong>Location Type:</strong></td>
                                <td><span class="badge bg-success">Dropdown Selection</span></td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td>{{ $enquiry->state?->name ?: '—' }}</td>
                            </tr>
                            <tr>
                                <td><strong>City:</strong></td>
                                <td>{{ $enquiry->city ?: '—' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pincode:</strong></td>
                                <td>{{ $enquiry->pincode ?: '—' }}</td>
                            </tr>
                        </table>
                    @else
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td width="150"><strong>Location Type:</strong></td>
                                <td><span class="badge bg-info">Manual Entry</span></td>
                            </tr>
                            <tr>
                                <td><strong>Location Details:</strong></td>
                                <td>{{ $enquiry->other_location ?: '—' }}</td>
                            </tr>
                        </table>
                    @endif
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Additional Information</h5>
                    @if($enquiry->notes)
                        <p>{{ $enquiry->notes }}</p>
                    @else
                        <p class="text-muted">No additional notes provided.</p>
                    @endif
                    
                    @if($enquiry->other)
                        <h6 class="mt-3">Other Details:</h6>
                        <p>{{ $enquiry->other }}</p>
                    @endif
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="mb-3">System Information</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="150"><strong>Submitted:</strong></td>
                            <td>{{ $enquiry->created_at?->format('d M Y, h:i A') }} ({{ $enquiry->created_at?->diffForHumans() }})</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated:</strong></td>
                            <td>{{ $enquiry->updated_at?->format('d M Y, h:i A') }} ({{ $enquiry->updated_at?->diffForHumans() }})</td>
                        </tr>
                        <tr>
                            <td><strong>User Agent:</strong></td>
                            <td class="text-monospace small">{{ $enquiry->user_agent ?: '—' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
