<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\UserProfileSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

        if ($submission->status === UserProfileSubmission::STATUS_APPROVED) {
            $this->syncCompanyFromSubmission($submission);
        }

        // Future enhancement: notify the submitting user about status changes.
        // Notification::send($submission->user, new ProfileSubmissionStatusNotification($submission));

        return redirect()
            ->route('admin.profile-submissions.show', $submission)
            ->with('success', 'Profile submission updated.');
    }

    protected function syncCompanyFromSubmission(UserProfileSubmission $submission): void
    {
        if (! $submission->user) {
            return;
        }

        $payload = $submission->payload ?? [];
        $allowedCompanyTypes = ['manufacturer', 'distributor', 'dealer', 'installer', 'wholesaler', 'retailer', 'epc'];

        $submittedType = Str::of($payload['business_type'] ?? $payload['company_type'] ?? '')
            ->lower()
            ->replace(' ', '')
            ->value();

        $companyType = in_array($submittedType, $allowedCompanyTypes, true)
            ? $submittedType
            : ($submission->form_type === UserProfileSubmission::FORM_SUPPLIER ? 'manufacturer' : 'distributor');

        $companyName = $payload['company_name']
            ?? $payload['registered_name']
            ?? $payload['owner_name']
            ?? $submission->user->name
            ?? 'Company ' . $submission->id;

        $contactName = $payload['owner_name']
            ?? $payload['primary_contact']
            ?? $payload['alternate_contact']
            ?? $submission->user->name
            ?? $companyName;

        $phone = $payload['primary_mobile']
            ?? $payload['owner_mobile']
            ?? $payload['alternate_mobile']
            ?? null;

        $email = $payload['primary_email']
            ?? $payload['owner_email']
            ?? $submission->user->email;

        $website = $payload['website_url'] ?? null;

        $yearOfEstablishment = isset($payload['year_of_establishment']) && is_numeric($payload['year_of_establishment'])
            ? (int) $payload['year_of_establishment']
            : null;

        $yearsInBusiness = null;
        if ($yearOfEstablishment && $yearOfEstablishment <= (int) now()->year) {
            $yearsInBusiness = max(0, (int) now()->year - $yearOfEstablishment);
        }

        $address = $payload['registered_address']
            ?? $payload['corporate_address']
            ?? $payload['operating_regions']
            ?? 'Not provided';

        $city = $payload['city']
            ?? $payload['operating_regions']
            ?? 'Not specified';

        $company = Company::firstOrNew(['owner_id' => $submission->user_id]);

        if (! $company->exists) {
            $company->slug = $this->generateUniqueSlug($companyName);
        }

        $company->company_type = $companyType;
        $company->owner_name = $contactName;
        $company->phone = $phone;
        $company->website_url = $website;
        $company->description = $payload['product_types']
            ?? $payload['operating_regions']
            ?? $payload['payment_terms']
            ?? $payload['review_notes']
            ?? null;
        $company->status = 'active';
        $company->email = $email;
        $company->years_in_business = $yearsInBusiness;
        $company->gst_number = $payload['gst_number'] ?? null;
        $company->address = $address;
        $company->city = $city;
        $company->pincode = $payload['pincode'] ?? '000000';
        $company->state_id = $company->state_id ?? null;
        $company->city_id = $company->city_id ?? null;
        $company->is_active = true;

        $company->save();
    }

    protected function generateUniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'company';
        $slug = $base;
        $counter = 1;

        while (Company::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
