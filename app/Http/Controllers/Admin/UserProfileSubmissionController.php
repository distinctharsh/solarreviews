<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfileSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserProfileSubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = UserProfileSubmission::statuses();

        $filters = $request->validate([
            'status' => ['nullable', Rule::in($statuses)],
            'form_type' => ['nullable', Rule::in([
                UserProfileSubmission::FORM_DISTRIBUTOR,
                UserProfileSubmission::FORM_SUPPLIER,
            ])],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $query = UserProfileSubmission::query()
            ->with(['user'])
            ->latest();

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['form_type'])) {
            $query->where('form_type', $filters['form_type']);
        }

        if (! empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', $search)
                    ->orWhere('email', 'like', $search);
            });
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.profile-submissions.index', [
            'submissions' => $submissions,
            'statuses' => $statuses,
            'filters' => [
                'status' => $filters['status'] ?? null,
                'form_type' => $filters['form_type'] ?? null,
                'search' => $filters['search'] ?? null,
            ],
        ]);
    }

    public function show(UserProfileSubmission $submission): View
    {
        $submission->load(['user', 'reviewer']);

        return view('admin.profile-submissions.show', [
            'submission' => $submission,
            'statuses' => UserProfileSubmission::statuses(),
        ]);
    }

    public function update(Request $request, UserProfileSubmission $submission): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(UserProfileSubmission::statuses())],
            'review_notes' => ['nullable', 'string'],
        ]);

        $submission->status = $data['status'];
        $submission->review_notes = $data['review_notes'] ?? null;

        if ($data['status'] === UserProfileSubmission::STATUS_PENDING) {
            $submission->reviewed_by = null;
            $submission->reviewed_at = null;
        } else {
            $submission->reviewed_by = Auth::id();
            $submission->reviewed_at = now();
        }

        $submission->save();

        // Future enhancement: notify the submitting user about status changes.
        // Notification::send($submission->user, new ProfileSubmissionStatusNotification($submission));

        return redirect()
            ->route('admin.profile-submissions.show', $submission)
            ->with('success', 'Profile submission updated.');
    }
}
