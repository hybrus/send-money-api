<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Bank::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $banks = [
            ["name" => "BDO UNIBANK INC", "is_active" => true, "is_disabled" => false],
            ["name" => "LAND BANK OF THE PHILIPPINES", "is_active" => true, "is_disabled" => false],
            ["name" => "BANK OF THE PHIL ISLANDS", "is_active" => true, "is_disabled" => true],
            ["name" => "METROPOLITAN BANK & TCO", "is_active" => true, "is_disabled" => true],
            ["name" => "CHINA BANKING CORP", "is_active" => false, "is_disabled" => true],
            ["name" => "RIZAL COMM'L BANKING CORP", "is_active" => false, "is_disabled" => true],
            ["name" => "PHIL NATIONAL BANK", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "DEVELOPMENT BANK OF THE PHIL", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "UNION BANK OF THE PHILS", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "SECURITY BANK CORP", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "EAST WEST BANKING CORP", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "CITIBANK, N.A.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "ASIA UNITED BANK CORPORATION", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "HONGKONG & SHANGHAI BANKING CORP", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "BANK OF COMMERCE", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "ROBINSONS BANK CORPORATION", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "PHIL TRUST COMPANY", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "PHIL BANK OF COMMUNICATIONS", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "STANDARD CHARTERED BANK", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "MIZUHO BANK LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "MUFG BANK, LTD.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "MAYBANK PHILIPPINES INCORPORATED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "CTBC BANK (PHILIPPINES) CORP", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "PHILIPPINE VETERANS BANK", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "JP MORGAN CHASE BANK NATIONAL ASSN.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "BANK OF CHINA (HONGKONG) LIMITED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "DEUTSCHE BANK AG", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "SUMITOMO MITSUI BANKING CORPORATION", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "AUSTRALIA AND NEW ZEALAND BANKING GROUP LIMITED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "BDO PRIVATE BANK, INC.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "KEB HANA BANK", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "CIMB BANK PHILIPPINES INC", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "BANK OF AMERICA N.A.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "ING BANK N.V.", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "MEGA INT'L COMM'L BANK CO LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "BANGKOK BANK PUBLIC COMPANY LIMITED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "INDUSTRIAL AND COMMERCIAL BANK OF CHINA LIMITED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "SHINHAN BANK", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "INDUSTRIAL BANK OF KOREA", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "HUA NAN COMMERCIAL BANK LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "CATHAY UNITED BANK CO LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "UNITED OVERSEAS BANK LIMITED", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "CHANG HWA COMMERCIAL BANK LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "FIRST COMMERCIAL BANK LTD", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
            ["name" => "AL-AMANAH ISLAMIC INVESTMENT BANK OF THE PHILS", "is_active" => array_rand([0, 1]), "is_disabled" => array_rand([0, 1])],
        ];

        Bank::insert($banks);
    }
}
