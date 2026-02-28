<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportCompanies extends Command
{
    protected $signature = 'import:companies {file}';
    protected $description = 'Import companies from CSV file';

    public function handle()
    {
        $filePath = storage_path('app/' . $this->argument('file'));

        if (!file_exists($filePath)) {
            $this->error('File not found.');
            return;
        }

        $handle = fopen($filePath, 'r');

        $header = fgetcsv($handle); // skip header

        $count = 0;

        while (($row = fgetcsv($handle)) !== false) {

            $ownerName = trim($row[0]);
            $phone = trim($row[1]);
            $email = trim($row[2]);
            $address = trim($row[3]);
            $city = trim($row[4]);
            $pincode = trim($row[5]);
            $stateId = $row[6] ?: null;
            $cityId = $row[7] ?: null;

            if (!$ownerName) {
                continue;
            }

            $slug = $this->generateUniqueSlug($ownerName);

            Company::create([
                'slug' => $slug,
                'company_type' => 'installer', // default (change if needed)
                'owner_name' => $ownerName,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'pincode' => $pincode,
                'state_id' => $stateId,
                'city_id' => $cityId,
                'status' => 'active',
                'is_active' => 1,
                'is_verified' => 0,
                'is_subscribed' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $count++;
        }

        fclose($handle);

        $this->info("Successfully imported {$count} companies.");
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Company::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}