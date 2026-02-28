<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ImportApprovedFirms extends Command
{
    protected $signature = 'import:approved-firms {file}';
    protected $description = 'Import approved firms into companies table';

public function handle()
{
    $filePath = storage_path('app/' . $this->argument('file'));

    if (!file_exists($filePath)) {
        $this->error("File not found.");
        return;
    }

    $this->info("Starting import...");

    $html = file_get_contents($filePath);

    libxml_use_internal_errors(true);

    $dom = new \DOMDocument();
    $dom->loadHTML($html);

    $xpath = new \DOMXPath($dom);
    $rows = $xpath->query('//table//tbody//tr');

    DB::beginTransaction();

    try {

        $count = 0;
        $stateId = 116; // fixed as you said

        foreach ($rows as $row) {

            $columns = $row->getElementsByTagName('td');

            if ($columns->length < 6) {
                continue;
            }

            $firmName = trim($columns->item(0)->nodeValue ?? '');
            $phone    = trim($columns->item(2)->nodeValue ?? '');
            $email    = trim($columns->item(3)->nodeValue ?? '');
            $cityName = ucwords(strtolower(trim($columns->item(4)->nodeValue ?? '')));
            $address  = trim($columns->item(5)->nodeValue ?? '');

            if (!$firmName || !$cityName || !$address) {
                continue;
            }

            /*
            =========================
            Resolve City under state 116
            =========================
            */

            $city = DB::table('cities')
                ->where('state_id', $stateId)
                ->whereRaw('LOWER(name) = ?', [strtolower($cityName)])
                ->first();

            $cityId = $city->id ?? null;

            /*
            =========================
            Unique Slug
            =========================
            */

            $baseSlug = \Str::slug($firmName);
            $slug = $baseSlug;
            $i = 1;

            while (DB::table('companies')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            /*
            =========================
            Insert Company
            =========================
            */

            DB::table('companies')->insert([
                'owner_id'       => null,
                'slug'           => $slug,
                'company_type'   => 'distributor',
                'owner_name'     => $firmName,
                'phone'          => $phone ?: null,
                'email'          => $email ?: null,
                'address'        => $address,
                'city'           => $cityName,
                'pincode'        => '000000',
                'state_id'       => $stateId,
                'city_id'        => $cityId,
                'status'         => 'active',
                'is_active'      => 1,
                'is_verified'    => 1,
                'is_subscribed'  => 0,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            $count++;

            if ($count % 100 === 0) {
                $this->output->write(".");
            }
        }

        DB::commit();

        $this->info("\n\n✅ Import completed successfully!");
        $this->info("Total imported: $count");

    } catch (\Exception $e) {

        DB::rollBack();
        $this->error("Import failed!");
        $this->error($e->getMessage());
    }
}
}