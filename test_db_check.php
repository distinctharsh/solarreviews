<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "Check 1: Base Connection\n";
try {
    DB::connection()->getPdo();
    echo "Connected successfully to database: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "Check 2: Table Existence (users)\n";
if (Schema::hasTable('users')) {
    echo "Table 'users' EXISTS.\n";
} else {
    echo "Table 'users' DOES NOT EXIST.\n";
}

echo "Check 3: Direct Select\n";
try {
    $count = DB::table('users')->count();
    echo "Users count: $count\n";
} catch (\Exception $e) {
    echo "Select failed: " . $e->getMessage() . "\n";
}
