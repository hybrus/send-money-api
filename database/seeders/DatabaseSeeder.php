<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        User::factory(10)->create();
        $this->call(AccountSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(BankProviderSeeder::class);
    }
}
