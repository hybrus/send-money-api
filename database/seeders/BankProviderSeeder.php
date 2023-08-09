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

        $banks = Bank::whereNotIn('id', [1, 2, 3, 4, 5, 6])->pluck('id');
        $providers = Provider::pluck('id')->toArray();

        $data = $banks->map(function ($bankID) use ($providers) {
            return [
                "bank_id" => $bankID,
                "provider_id" => $providers[array_rand($providers)],
            ];
        })
            ->toArray();

        //for demo pupose or defaults;
        $data[] = ["bank_id" => 1, "provider_id" => 1];
        $data[] = ["bank_id" => 2, "provider_id" => 2];
        $data[] = ["bank_id" => 3, "provider_id" => 1];
        $data[] = ["bank_id" => 4, "provider_id" => 2];
        $data[] = ["bank_id" => 5, "provider_id" => 1];
        $data[] = ["bank_id" => 6, "provider_id" => 2];

        $db->insert($data);
    }
}
