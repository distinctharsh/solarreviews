@extends('admin.layouts.app')

@section('page_title', 'Company Detail Request')

@section('content')
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between flex-wrap gap-3">
            <div>
                <a href="{{ route('admin.company-detail-requests.index') }}" class="btn btn-sm btn-link px-0 text-decoration-none text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <h2 class="mb-1">{{ $request->name }}</h2>
                <div class="text-muted">Submitted {{ $request->created_at?->format('d M Y, h:i A') }}</div>
            </div>
           
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Request details</h3>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Mobile</div>
                            <div class="detail-value">{{ $request->mobile_number }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">{{ $request->email ?: '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">{{ $request->location ?: '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Company</div>
                            <div class="detail-value">
                                @if($request->company)
                                    {{ $request->company->owner_name ?? 'Company' }}
                                    <div class="text-muted small">#{{ $request->company->id }}</div>
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="detail-label">Message</div>
                        <div class="detail-notes">{{ $request->message ?: '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">System</h3>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Request ID</div>
                            <div class="detail-value">#{{ $request->id }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Updated</div>
                            <div class="detail-value">{{ $request->updated_at?->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
}
.detail-item {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    background: #fff;
}
.detail-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 6px;
}
.detail-value {
    font-weight: 600;
    color: #0f172a;
}
.detail-notes {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    background: #f8fafc;
    white-space: pre-wrap;
}
</style>
@endpush
