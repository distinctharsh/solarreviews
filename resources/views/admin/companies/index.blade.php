<!-- resources/views/admin/companies/index.blade.php -->
@extends('admin.layouts.app')

@section('page_title', 'Companies')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Companies</h1>
        <p class="text-muted">Manage registered companies</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Company
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->owner_name }}</td>
                    <td>{{ ucfirst($company->company_type) }}</td>
                    <td>{{ $company->owner_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>
                        <span class="badge badge-{{ $company->status === 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($company->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No companies found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection