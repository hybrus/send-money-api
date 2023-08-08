<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::truncate();
        $userIDs = User::pluck('id')->toArray();

        foreach ($userIDs as  $id) {
            Account::create(['user_id' => $id, 'available_balance' => 5000]);
        }
    }
}
