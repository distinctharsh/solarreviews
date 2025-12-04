<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Company;
use App\Models\Product;
use App\Models\Review;
use App\Models\RatingSummary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ReviewSeeder extends Seeder
{
    private int $targetReviewCount = 40;

    private array $snippets = [
        'Super helpful support team and neat workmanship.',
        'Delivery was quick and documentation crystal clear.',
        'Saw a big drop in bills within the first cycle.',
        'Great value for money compared to other bids.',
        'Monitoring app could be prettier but data is accurate.',
        'Installation crew maintained good safety practices.',
        'After-sales service was proactive and transparent.',
        'Commissioning was completed ahead of schedule with zero rework.',
        'Performance ratio is consistently better than what we modeled.',
        'Proactive alerts helped us fix a loose connector before it failed.',
        'Loan paperwork and subsidy documentation were handled smoothly.',
        'Packaging was sturdy and every accessory was properly labeled.',
    ];

    public function run(): void
    {
        Review::query()->delete();
        RatingSummary::query()->delete();

        $users = User::pluck('id')->take(20);
        if ($users->isEmpty()) {
            $users = User::factory()->count(5)->create()->pluck('id');
        }

        $groups = [
            Company::all(),
            Brand::all(),
            Product::all(),
        ];

        foreach ($groups as $collection) {
            $this->seedGroup($collection, $users);
        }
    }

    private function seedGroup($collection, $users): void
    {
        $groupCount = 0;

        foreach ($collection as $model) {
            $count = rand(4, 8);
            $groupCount += $count;
            $this->generateReviews($model, $users, $count);
        }

        while ($groupCount < $this->targetReviewCount && $collection->isNotEmpty()) {
            $this->generateReviews($collection->random(), $users, 1);
            $groupCount++;
        }
    }

    private function generateReviews($model, $users, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $review = Review::create([
                'user_id' => $users->random(),
                'reviewable_type' => get_class($model),
                'reviewable_id' => $model->id,
                'rating' => $rating = rand(3, 5),
                'title' => Arr::random(['Solid choice', 'Worth it', 'Reliable ops', 'Dependable partner']),
                'comment' => Arr::random($this->snippets),
                'images' => [],
            ]);

            RatingSummary::updateFor($review);
        }
    }
}