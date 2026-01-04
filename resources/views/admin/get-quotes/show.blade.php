@extends('admin.layouts.app')

@section('page_title', 'Get Quote Request')

@section('content')
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between flex-wrap gap-3">
            <div>
                <a href="{{ route('admin.get-quotes.index') }}" class="btn btn-sm btn-link px-0 text-decoration-none text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back to Get Quotes
                </a>
                <h2 class="mb-1">{{ $quote->name }}</h2>
                <div class="text-muted">Submitted {{ $quote->created_at?->format('d M Y, h:i A') }}</div>
            </div>
            <div class="d-flex gap-2 flex-wrap align-items-start">
                @if($quote->email)
                    <a class="btn btn-sm btn-outline-primary" href="mailto:{{ $quote->email }}">
                        <i class="fas fa-envelope me-1"></i> Email
                    </a>
                @endif
                <a class="btn btn-sm btn-outline-secondary" href="tel:{{ $quote->mobile_number }}">
                    <i class="fas fa-phone me-1"></i> Call
                </a>
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
                            <div class="detail-label">Service type</div>
                            <div class="detail-value">{{ $quote->service_type }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Mobile</div>
                            <div class="detail-value">{{ $quote->mobile_number }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">{{ $quote->email ?: '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">{{ $quote->location ?: '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">State</div>
                            <div class="detail-value">{{ $quote->state?->name ?: '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Company</div>
                            <div class="detail-value">
                                @if($quote->company)
                                    {{ $quote->company->owner_name ?? 'Company' }}
                                    <div class="text-muted small">#{{ $quote->company->id }}</div>
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="detail-label">Notes</div>
                        <div class="detail-notes">{{ $quote->notes ?: '—' }}</div>
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
                    <div class="text-muted">No additional system fields are stored in <code>get_quotes</code>.</div>
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
