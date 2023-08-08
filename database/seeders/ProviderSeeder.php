<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        Provider::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $providers = [
            ["name" => "InstaPay", "is_active" => true, "is_disabled" => false],
            ["name" => "PESONet", "is_active" => true, "is_disabled" => false],
            ["name" => "DisabledProvider Demo", "is_active" => true, "is_disabled" => true],
            ["name" => "NoShowProvider Demo", "is_active" => false, "is_disabled" => false],
        ];

        Provider::insert($providers);
    }
}
