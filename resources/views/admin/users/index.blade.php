@extends('admin.layouts.app')

@section('page_title', 'Users')

@section('content')
<div class="container-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Users</h1>
    </div>

    <!-- Debug Info -->
    <!-- <div class="alert alert-info">
        <strong>Debug:</strong> Total Users: {{ $users->count() }} | Available Companies: {{ $availableCompanies->count() }}
    </div> -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Owner Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    @if($user->company_id)
                                        {{ $user->company->owner_name }}
                                    @else
                                        <form method="POST" action="{{ route('admin.users.assign-company', $user->id) }}" class="d-inline">
                                            @csrf
                                            <div class="position-relative">
                                                <select name="company_id" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 200px;" onfocus="showSearchBox({{ $user->id }})" onblur="hideSearchBox({{ $user->id }})">
                                                    <option value="">Select Company</option>
                                                    @forelse($availableCompanies as $company)
                                                        <option value="{{ $company->id }}" data-name="{{ strtolower($company->owner_name) }}">{{ $company->owner_name }}</option>
                                                    @empty
                                                        <option value="">No companies available</option>
                                                    @endforelse
                                                </select>
                                                <div id="search-box-{{ $user->id }}" class="search-box-dropdown" style="display: none;">
                                                    <input type="text" placeholder="Search company..." 
                                                           class="form-control form-control-sm" 
                                                           onkeyup="filterDropdown({{ $user->id }})"
                                                           onclick="event.stopPropagation()">
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.search-box-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;
    background: white;
    border: 1px solid #dee2e6;
    border-top: none;
    padding: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.search-box-dropdown input {
    width: 100%;
}
</style>

<script>
function showSearchBox(userId) {
    const searchBox = document.getElementById('search-box-' + userId);
    searchBox.style.display = 'block';
    searchBox.querySelector('input').focus();
}

function hideSearchBox(userId) {
    setTimeout(() => {
        const searchBox = document.getElementById('search-box-' + userId);
        searchBox.style.display = 'none';
    }, 200);
}

function filterDropdown(userId) {
    const searchInput = document.getElementById('search-box-' + userId).querySelector('input');
    const selectElement = document.querySelector('select[name="company_id"]');
    const searchTerm = searchInput.value.toLowerCase();
    
    // Get all options except first one (placeholder)
    const options = selectElement.querySelectorAll('option:not(:first-child)');
    
    options.forEach(option => {
        const companyName = option.getAttribute('data-name');
        if (companyName.includes(searchTerm)) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}
</script>
@endsection
