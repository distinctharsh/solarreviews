<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfileSubmission;
use App\Notifications\NewProfileSubmissionNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;

class UserProfileSubmissionController extends Controller
{
    public function storeDistributor(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user?->isDistributor(), 403);

        $payload = $this->preparePayload($request, UserProfileSubmission::FORM_DISTRIBUTOR);

        $submission = UserProfileSubmission::updateOrCreate(
            ['user_id' => $user->id, 'form_type' => UserProfileSubmission::FORM_DISTRIBUTOR],
            [
                'payload' => $payload,
                'status' => UserProfileSubmission::STATUS_PENDING,
                'review_notes' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
            ]
        );

        $this->notifyAdmins($submission);

        return back()->with('status', 'distributor-profile-submitted');
    }

    public function storeSupplier(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user?->isManufacturer() || $user?->isSupplier(), 403);

        $payload = $this->preparePayload($request, UserProfileSubmission::FORM_SUPPLIER);

        $submission = UserProfileSubmission::updateOrCreate(
            ['user_id' => $user->id, 'form_type' => UserProfileSubmission::FORM_SUPPLIER],
            [
                'payload' => $payload,
                'status' => UserProfileSubmission::STATUS_PENDING,
                'review_notes' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
            ]
        );

        $this->notifyAdmins($submission);

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

    protected function notifyAdmins(UserProfileSubmission $submission): void
    {
        $admins = User::query()
            ->where('is_admin', true)
            ->get();

        if ($admins->isEmpty()) {
            return;
        }

        Notification::send($admins, new NewProfileSubmissionNotification($submission->fresh('user')));
    }
}
