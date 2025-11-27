<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRatingSummaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-rating-summaries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // app/Console/Commands/GenerateRatingSummaries.php
    public function handle()
    {
        $models = [\App\Models\Product::class, \App\Models\Company::class, \App\Models\Brand::class];
        
        foreach ($models as $model) {
            $model::chunk(100, function ($items) {
                foreach ($items as $item) {
                    $reviews = $item->reviews();
                    
                    \App\Models\RatingSummary::updateOrCreate(
                        [
                            'reviewable_type' => $item->getMorphClass(),
                            'reviewable_id' => $item->id,
                        ],
                        [
                            'avg_rating' => $reviews->avg('rating') ?? 0,
                            'total_reviews' => $reviews->count(),
                        ]
                    );
                }
            });
        }

        $this->info('Rating summaries generated successfully!');
    }
}
