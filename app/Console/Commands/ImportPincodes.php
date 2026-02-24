<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportPincodes extends Command
{
    protected $signature = 'import:pincodes {file}';
    protected $description = 'Import pincodes from CSV file';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found!");
            return;
        }

        $this->info("Starting import...");

        $file = fopen($filePath, 'r');

        if (!$file) {
            $this->error("Unable to open file.");
            return;
        }

        // Skip header row
        fgetcsv($file);

        DB::beginTransaction();

        try {

            $rowCount = 0;

            while (($row = fgetcsv($file)) !== false) {

                // CSV Mapping
                $pincode   = trim($row[4] ?? '');
                $cityName  = ucwords(strtolower(trim($row[7] ?? '')));
                $stateName = ucwords(strtolower(trim($row[8] ?? '')));

                // Basic validation
                if (!$pincode || !$cityName || !$stateName) {
                    continue;
                }

                if (!is_numeric($pincode) || strlen($pincode) != 6) {
                    continue;
                }

                /*
                =================================
                1️⃣ HANDLE STATE (by slug)
                =================================
                */

                $stateSlug = Str::slug($stateName);

                $state = DB::table('states')
                    ->where('slug', $stateSlug)
                    ->first();

                if (!$state) {
                    $stateId = DB::table('states')->insertGetId([
                        'name' => $stateName,
                        'slug' => $stateSlug,
                        'code' => null,
                        'description' => null,
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $stateId = $state->id;
                }

                /*
                =================================
                2️⃣ HANDLE CITY (by slug + state)
                =================================
                */

                $citySlug = Str::slug($cityName);

                $city = DB::table('cities')
                    ->where('state_id', $stateId)
                    ->where('slug', $citySlug)
                    ->first();

                if (!$city) {
                    $cityId = DB::table('cities')->insertGetId([
                        'state_id' => $stateId,
                        'name' => $cityName,
                        'slug' => $citySlug,
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $cityId = $city->id;
                }

                /*
                =================================
                3️⃣ INSERT PINCODE
                =================================
                */

                DB::table('pincodes')->insertOrIgnore([
                    'state_id' => $stateId,
                    'city_id' => $cityId,
                    'city_name' => $cityName,
                    'pincode' => $pincode,
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $rowCount++;

                // Lightweight progress indicator
                if ($rowCount % 1000 === 0) {
                    $this->output->write(".");
                }
            }

            fclose($file);

            DB::commit();

            $this->info("\n\n✅ Import completed successfully!");
            $this->info("Total processed rows: " . $rowCount);

        } catch (\Exception $e) {

            DB::rollBack();

            $this->error("\n❌ Import failed!");
            $this->error($e->getMessage());
        }
    }
}