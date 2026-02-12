<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProjectController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_location' => ['required', 'string', 'max:255'],
            'total_capacity_kw' => ['nullable', 'numeric', 'min:0'],
            'installation_type' => ['nullable', 'string', 'max:255'],
            'financial_model' => ['nullable', 'string', 'max:255'],
            'average_generation_units_per_kw_year' => ['nullable', 'numeric', 'min:0'],
            'contact_no' => ['nullable', 'string', 'max:255'],
            'email_id' => ['nullable', 'email', 'max:255'],
            'show_contact_on_frontend' => ['nullable', 'boolean'],
            'show_email_on_frontend' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array', 'max:4'],
            'images.*' => ['nullable', 'image', 'max:5120'],
        ]);

        $project = Project::create([
            'user_id' => $user->id,
            'company_id' => $user->company?->id,
            'site_name' => $validated['site_name'],
            'site_location' => $validated['site_location'],
            'total_capacity_kw' => $validated['total_capacity_kw'] ?? null,
            'installation_type' => $validated['installation_type'] ?? null,
            'financial_model' => $validated['financial_model'] ?? null,
            'average_generation_units_per_kw_year' => $validated['average_generation_units_per_kw_year'] ?? null,
            'contact_no' => $validated['contact_no'] ?? null,
            'email_id' => $validated['email_id'] ?? null,
            'show_contact_on_frontend' => (bool) ($validated['show_contact_on_frontend'] ?? false),
            'show_email_on_frontend' => (bool) ($validated['show_email_on_frontend'] ?? false),
        ]);

        $images = $request->file('images', []);
        $directory = sprintf('projects/%s/%s', $user->id, $project->id);

        foreach ($images as $index => $file) {
            if (!$file instanceof UploadedFile) {
                continue;
            }

            $path = $file->store($directory, 'public');

            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path,
                'sort_order' => (int) $index,
            ]);
        }

        return back()->with('status', 'project-created');
    }

    public function destroy(Request $request, Project $project): RedirectResponse
    {
        $user = $request->user();

        abort_unless((int) $project->user_id === (int) $user->id, 403);

        $project->delete();

        return back()->with('status', 'project-deleted');
    }
}
