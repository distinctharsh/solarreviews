<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceTypeController extends Controller
{
    public function index(): View
    {
        $services = ServiceType::orderBy('name')->paginate(20)->withQueryString();

        return view('admin.catalog.service-types.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.catalog.service-types.form', [
            'service' => new ServiceType(),
            'title' => 'Add Service Type',
            'route' => route('admin.catalog.service-types.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        ServiceType::create($data);

        return redirect()
            ->route('admin.catalog.service-types.index')
            ->with('success', 'Service type created successfully.');
    }

    public function edit(ServiceType $serviceType): View
    {
        return view('admin.catalog.service-types.form', [
            'service' => $serviceType,
            'title' => 'Edit Service Type',
            'route' => route('admin.catalog.service-types.update', $serviceType),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, ServiceType $serviceType): RedirectResponse
    {
        $data = $this->validateData($request, $serviceType->id);
        $serviceType->update($data);

        return redirect()
            ->route('admin.catalog.service-types.index')
            ->with('success', 'Service type updated.');
    }

    public function destroy(ServiceType $serviceType): RedirectResponse
    {
        $serviceType->delete();

        return redirect()
            ->route('admin.catalog.service-types.index')
            ->with('success', 'Service type deleted.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:service_types,slug'.($id ? ','.$id : '')],
            'service_group' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
