<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyReview;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanyReviewSeeder extends Seeder
{
    private array $reviews = [
        [
            'company' => 'sunline-renewables',
            'reviewer' => 'Ritu Sharma',
            'email' => 'ritu.sharma@example.com',
            'rating' => 5,
            'title' => 'Flawless install for our textile unit',
            'text' => 'Sunline optimized the array spacing and delivered the handover kit a week early.',
            'date' => '2024-08-12',
            'source' => 'Google',
            'featured' => true,
        ],
        [
            'company' => 'sunline-renewables',
            'reviewer' => 'Aakash Lakhani',
            'email' => 'aakash.lakhani@example.com',
            'rating' => 4,
            'title' => 'Neat workmanship',
            'text' => 'Team handled permissions and net-metering without any follow-ups from us.',
            'date' => '2024-05-03',
            'source' => 'Trustpilot',
        ],
        [
            'company' => 'brightvolt-solar-works',
            'reviewer' => 'Nikita Dumbre',
            'email' => 'nikita.dumbre@example.com',
            'rating' => 5,
            'title' => 'Hybrid project delivered smoothly',
            'text' => 'Brightvolt sized the battery bank accurately and shared clear CAD drawings.',
            'date' => '2024-07-19',
            'source' => 'Website',
        ],
        [
            'company' => 'brightvolt-solar-works',
            'reviewer' => 'Harshit Naik',
            'email' => 'harshit.naik@example.com',
            'rating' => 4,
            'title' => 'Responsive during commissioning',
            'text' => 'Minor inverter settings were fixed via remote support the same day.',
            'date' => '2023-12-11',
            'source' => 'Google',
        ],
        [
            'company' => 'heliowave-energy',
            'reviewer' => 'Shreya Kapoor',
            'email' => 'shreya.kapoor@example.com',
            'rating' => 5,
            'title' => 'Module supply exceeded expectations',
            'text' => 'BIS certificates and EL reports were shared upfront. Delivery came padded.',
            'date' => '2024-09-02',
            'source' => 'Facebook',
        ],
        [
            'company' => 'heliowave-energy',
            'reviewer' => 'Vineet Dalal',
            'email' => 'vineet.dalal@example.com',
            'rating' => 4,
            'title' => 'Good post-sales coordination',
            'text' => 'HelioWave replaced two damaged pallets in 48 hours without dispute.',
            'date' => '2023-11-15',
            'source' => 'Yelp',
        ],
        [
            'company' => 'evergrid-solar-partners',
            'reviewer' => 'Manasa Pai',
            'email' => 'manasa.pai@example.com',
            'rating' => 5,
            'title' => 'Dealer support we trust',
            'text' => 'Evergrid helped negotiate financing and stocked urgent SMA parts overnight.',
            'date' => '2024-04-08',
            'source' => 'Google',
        ],
        [
            'company' => 'evergrid-solar-partners',
            'reviewer' => 'Rahul Hegde',
            'email' => 'rahul.hegde@example.com',
            'rating' => 3,
            'title' => 'Could improve delivery tracking',
            'text' => 'Inventory visibility was delayed, but final dispatch arrived on time.',
            'date' => '2023-10-22',
            'source' => 'Facebook',
        ],
        [
            'company' => 'radiant-roof-solutions',
            'reviewer' => 'Priyanka Venkatesh',
            'email' => 'priyanka.venkatesh@example.com',
            'rating' => 5,
            'title' => 'Tracker retrofit success',
            'text' => 'Roof loading calculations and cable trays were documented meticulously.',
            'date' => '2024-03-18',
            'source' => 'Website',
            'featured' => true,
        ],
        [
            'company' => 'radiant-roof-solutions',
            'reviewer' => 'Suhail Rahman',
            'email' => 'suhail.rahman@example.com',
            'rating' => 4,
            'title' => 'AMC visits on schedule',
            'text' => 'Technicians document IV-curve tests each quarter which keeps us compliant.',
            'date' => '2023-09-05',
            'source' => 'Trustpilot',
        ],
        [
            'company' => 'zenith-sun-distributors',
            'reviewer' => 'Govind Malhotra',
            'email' => 'govind.malhotra@example.com',
            'rating' => 4,
            'title' => 'Reliable stocking partner',
            'text' => 'Zenith staggered deliveries based on our project phases without extra fees.',
            'date' => '2024-06-26',
            'source' => 'Website',
        ],
        [
            'company' => 'zenith-sun-distributors',
            'reviewer' => 'Alka Suri',
            'email' => 'alka.suri@example.com',
            'rating' => 5,
            'title' => 'Fast credit approvals',
            'text' => 'Paperwork for distributor credit was done in two days including insurance.',
            'date' => '2023-12-28',
            'source' => 'Google',
        ],
        [
            'company' => 'greenpulse-power-corp',
            'reviewer' => 'Deepankar Jain',
            'email' => 'deepankar.jain@example.com',
            'rating' => 5,
            'title' => 'PPA reporting is transparent',
            'text' => 'Monthly generation dashboards and ticket SLAs are shared proactively.',
            'date' => '2024-08-01',
            'source' => 'Website',
        ],
        [
            'company' => 'greenpulse-power-corp',
            'reviewer' => 'Vasudha Rathi',
            'email' => 'vasudha.rathi@example.com',
            'rating' => 4,
            'title' => 'Smooth corporate approvals',
            'text' => 'GreenPulse navigated fire safety and electrical audits without delays.',
            'date' => '2023-06-17',
            'source' => 'Facebook',
        ],
        [
            'company' => 'suryanet-retail',
            'reviewer' => 'Esha Banerjee',
            'email' => 'esha.banerjee@example.com',
            'rating' => 5,
            'title' => 'Retail staff knows their gear',
            'text' => 'They demoed the monitoring app and configured hybrid settings before dispatch.',
            'date' => '2024-05-27',
            'source' => 'Google',
        ],
        [
            'company' => 'suryanet-retail',
            'reviewer' => 'Soumik Pal',
            'email' => 'soumik.pal@example.com',
            'rating' => 4,
            'title' => 'Store pickup was quick',
            'text' => 'Pickup slot was honoured and technicians loaded the kit safely.',
            'date' => '2023-07-04',
            'source' => 'Website',
        ],
        [
            'company' => 'nexsun-components',
            'reviewer' => 'Mahesh Biyani',
            'email' => 'mahesh.biyani@example.com',
            'rating' => 5,
            'title' => 'Best BOS pricing',
            'text' => 'Bulk clamps and earthing kits were bundled with detailed QA reports.',
            'date' => '2024-02-09',
            'source' => 'Google',
        ],
        [
            'company' => 'nexsun-components',
            'reviewer' => 'Harinder Sethi',
            'email' => 'harinder.sethi@example.com',
            'rating' => 3,
            'title' => 'Packaging can improve',
            'text' => 'One carton of cable glands had dents but replacements were issued in 2 days.',
            'date' => '2023-09-29',
            'source' => 'Trustpilot',
        ],
        [
            'company' => 'prana-solar-systems',
            'reviewer' => 'Bidisha Bora',
            'email' => 'bidisha.bora@example.com',
            'rating' => 5,
            'title' => 'Microgrid team is proactive',
            'text' => 'They trained our operators in Assamese and provided laminated SOP charts.',
            'date' => '2024-06-02',
            'source' => 'Website',
        ],
        [
            'company' => 'prana-solar-systems',
            'reviewer' => 'Sunit Phukan',
            'email' => 'sunit.phukan@example.com',
            'rating' => 4,
            'title' => 'Rooftop install handled rain delays',
            'text' => 'Waterproofing warranty was extended due to monsoon stoppages.',
            'date' => '2023-08-21',
            'source' => 'Google',
        ],
        [
            'company' => 'solarcraft-infra',
            'reviewer' => 'Ananya Goyal',
            'email' => 'ananya.goyal@example.com',
            'rating' => 5,
            'title' => 'Great textile park partner',
            'text' => 'Remote monitoring and O&M planners are shared before every visit.',
            'date' => '2024-01-18',
            'source' => 'Facebook',
        ],
        [
            'company' => 'solarcraft-infra',
            'reviewer' => 'Raghav Patel',
            'email' => 'raghav.patel@example.com',
            'rating' => 4,
            'title' => 'Commissioning docs are thorough',
            'text' => 'They prepared a punch list and resolved the items before handover.',
            'date' => '2023-05-30',
            'source' => 'Website',
        ],
    ];

    public function run(): void
    {
        CompanyReview::query()->truncate();

        $companies = Company::pluck('id', 'slug');
        $reviewedCompanyIds = [];

        foreach ($this->reviews as $review) {
            $companyId = $companies[$review['company']] ?? null;

            if (!$companyId) {
                continue;
            }

            $reviewedCompanyIds[] = $companyId;

            CompanyReview::create([
                'company_id' => $companyId,
                'category_id' => null,
                'state_id' => null,
                'reviewer_name' => $review['reviewer'],
                'email' => $review['email'],
                'rating' => $review['rating'],
                'review_title' => $review['title'],
                'review_text' => $review['text'],
                'review_date' => Carbon::parse($review['date']),
                'source' => $review['source'],
                'is_featured' => $review['featured'] ?? false,
                'is_approved' => true,
            ]);
        }

        Company::whereIn('id', array_unique($reviewedCompanyIds))
            ->each(fn ($company) => $company->updateAverageRating());
    }
}