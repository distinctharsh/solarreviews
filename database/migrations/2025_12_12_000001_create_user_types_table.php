<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $now = now();
        $defaults = [
            ['name' => 'Regular', 'slug' => 'regular'],
            ['name' => 'Distributor / Service Provider', 'slug' => 'distributor'],
            ['name' => 'Manufacturer', 'slug' => 'manufacturer'],
            ['name' => 'Supplier', 'slug' => 'supplier'],
        ];

        foreach ($defaults as $type) {
            DB::table('user_types')->updateOrInsert(
                ['slug' => $type['slug']],
                ['name' => $type['name'], 'updated_at' => $now, 'created_at' => $now]
            );
        }

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_type_id')
                ->nullable()
                ->after('user_type')
                ->constrained('user_types')
                ->nullOnDelete();
        });

        $typeMap = DB::table('user_types')->pluck('id', 'slug');

        foreach ($typeMap as $slug => $id) {
            DB::table('users')
                ->where('user_type', $slug)
                ->update(['user_type_id' => $id]);
        }

        if ($typeMap->has('regular')) {
            DB::table('users')
                ->whereNull('user_type_id')
                ->update(['user_type_id' => $typeMap['regular']]);
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'user_type')) {
                $table->dropColumn('user_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['regular', 'distributor', 'manufacturer', 'supplier'])
                ->default('regular')
                ->after('status');
        });

        $typeMap = DB::table('user_types')->pluck('slug', 'id');

        foreach ($typeMap as $id => $slug) {
            DB::table('users')
                ->where('user_type_id', $id)
                ->update(['user_type' => $slug]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_type_id');
        });

        Schema::dropIfExists('user_types');
    }
};
