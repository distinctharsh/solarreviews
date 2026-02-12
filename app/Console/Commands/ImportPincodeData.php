<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImportPincodeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-pincode-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    set_time_limit(0);

    $filePath = storage_path('app/pincode_data.csv');

    if (!file_exists($filePath)) {
        $this->error("File not found!");
        return;
    }

    $handle = fopen($filePath, 'r');
    fgetcsv($handle); // skip header

    $now = now();

    $stateMap = [];
    $cityMap = [];

    while (($row = fgetcsv($handle)) !== false) {

        $pincode = trim($row[0]);
        $cityName = trim($row[1]);
        $stateName = trim($row[2]);

        if (!$pincode || !$cityName || !$stateName) continue;

        // STATE
        if (!isset($stateMap[$stateName])) {

            $stateSlug = Str::slug($stateName);
            $stateCode = strtoupper(substr($stateSlug, 0, 5));

            $state = DB::table('states')->where('slug', $stateSlug)->first();

            if (!$state) {
                $stateId = DB::table('states')->insertGetId([
                    'name' => $stateName,
                    'slug' => $stateSlug,
                    'code' => $stateCode,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $stateId = $state->id;
            }

            $stateMap[$stateName] = $stateId;
        }

        $stateId = $stateMap[$stateName];

        // CITY
        $cityKey = $stateId . '_' . $cityName;

        if (!isset($cityMap[$cityKey])) {

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
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $cityId = $city->id;
            }

            $cityMap[$cityKey] = $cityId;
        }

        $cityId = $cityMap[$cityKey];

        // PINCODE
        DB::table('pincodes')->insertOrIgnore([
            'state_id' => $stateId,
            'city_id' => $cityId,
            'city_name' => $cityName,
            'pincode' => $pincode,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    fclose($handle);

    $this->info("Import completed successfully.");
}

}
