<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyReview;
use App\Models\NormalUser;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class NormalUserProfileController extends Controller
{
    public function index(Request $request): View
    {
        $normalUserId = Session::get('normal_user_id');

        if (!$normalUserId) {
            return redirect()->route('reviews.write')
                ->with('google_oauth_error', 'Please sign in with Google to view your profile.');
        }

        $normalUser = NormalUser::findOrFail($normalUserId);

        $reviews = CompanyReview::query()
            ->where('normal_user_id', $normalUserId)
            ->with([
                'company:id,owner_name,slug,logo_url',
                'state:id,name',
            ])
            ->orderByDesc('created_at')
            ->get();

        $draftReviews = $reviews->filter(fn ($review) => !$review->is_approved);
        $publishedReviews = $reviews->filter(fn ($review) => $review->is_approved);
        $location = optional(
            $reviews->first(fn ($review) => $review->state)?->state
        )->name ?? 'India';

        $avatarInitial = strtoupper(mb_substr($normalUser->name ?? ($normalUser->email ?? 'Reviewer'), 0, 1));

        $stats = [
            'reviews' => $publishedReviews->count(),
            'read' => 0,
            'useful' => 0,
        ];

        $states = State::query()
            ->select('id', 'name')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('frontend.normal-user.profile', [
            'normalUser' => $normalUser,
            'draftReviews' => $draftReviews,
            'publishedReviews' => $publishedReviews,
            'stats' => $stats,
            'location' => $location,
            'avatarInitial' => $avatarInitial,
            'states' => $states,
        ]);
    }

    public function update(Request $request, CompanyReview $companyReview): RedirectResponse|JsonResponse
    {
        $this->authorizeReview($companyReview);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'review_title' => ['nullable', 'string', 'max:255'],
            'review_text' => ['required', 'string'],
        ]);

        $companyReview->update([
            'rating' => $validated['rating'],
            'review_title' => $validated['review_title'] ?? null,
            'review_text' => $validated['review_text'],
            'is_approved' => false,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Review updated. It will be re-approved shortly.',
            ]);
        }

        return redirect()
            ->back()
            ->with('normal_user_success', 'Review updated. It will be re-approved shortly.');
    }

    public function destroy(Request $request, CompanyReview $companyReview): RedirectResponse
    {
        $this->authorizeReview($companyReview);
        $companyReview->delete();

        return redirect()
            ->back()
            ->with('normal_user_success', 'Review deleted successfully.');
    }

    protected function authorizeReview(CompanyReview $companyReview): void
    {
        $normalUserId = Session::get('normal_user_id');
        abort_unless($normalUserId && $companyReview->normal_user_id === $normalUserId, 403);
    }
}
