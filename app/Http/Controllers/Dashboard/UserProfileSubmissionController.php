<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserProfileSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UserProfileSubmissionController extends Controller
{
    public function storeDistributor(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user?->isDistributor(), 403);

        $payload = $this->preparePayload($request, UserProfileSubmission::FORM_DISTRIBUTOR);

        UserProfileSubmission::updateOrCreate(
            ['user_id' => $user->id, 'form_type' => UserProfileSubmission::FORM_DISTRIBUTOR],
            ['payload' => $payload]
        );

        return back()->with('status', 'distributor-profile-submitted');
    }

    public function storeSupplier(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user?->isManufacturer(), 403);

        $payload = $this->preparePayload($request, UserProfileSubmission::FORM_SUPPLIER);

        UserProfileSubmission::updateOrCreate(
            ['user_id' => $user->id, 'form_type' => UserProfileSubmission::FORM_SUPPLIER],
            ['payload' => $payload]
        );

        return back()->with('status', 'supplier-profile-submitted');
    }

    /**
     * Collect request payload along with stored file paths so we persist everything in DB.
     */
    protected function preparePayload(Request $request, string $formType): array
    {
        $data = $request->except('_token');
        $files = $request->allFiles();

        if (empty($files)) {
            return $data;
        }

        $directory = sprintf('profile-submissions/%s/%s', $formType, $request->user()?->id ?? 'guest');

        foreach ($files as $key => $value) {
            $data[$key] = $this->storeFileValue($value, $directory);
        }

        return $data;
    }

    /**
     * Handle single or multi file inputs and return stored path(s).
     */
    protected function storeFileValue(UploadedFile|array|null $value, string $directory): mixed
    {
        if (is_array($value)) {
            $stored = [];
            foreach ($value as $subKey => $file) {
                if ($file instanceof UploadedFile) {
                    $stored[$subKey] = $file->store($directory, 'public');
                }
            }

            return $stored;
        }

        if ($value instanceof UploadedFile) {
            return $value->store($directory, 'public');
        }

        return null;
    }
}
