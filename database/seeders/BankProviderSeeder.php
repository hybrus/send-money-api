<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $db = DB::table('bank_provider');
        $db->truncate();

        $banks = Bank::pluck('id');
        $providers = Provider::pluck('id')->toArray();

        $data = $banks->map(function ($bankID) use ($providers) {
            return [
                "bank_id" => $bankID,
                "provider_id" => $providers[array_rand($providers)],
            ];
        })
            ->toArray();

        $db->insert($data);
    }
}
