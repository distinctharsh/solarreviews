@if(auth()->check() && auth()->user()->is_admin)
    <script>
        window.location.href = '{{ route('admin.dashboard') }}';
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in as a regular user. This is the user dashboard.") }}
                        <div class="mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                                Go to Admin Dashboard
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
@endif
