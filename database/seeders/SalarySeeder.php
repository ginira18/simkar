<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salaries')->insert([
            [
                'id' => 1,
                'base_salary' => 5000000,
                'fix_allowance' => 1000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'base_salary' => 6000000,
                'fix_allowance' => 1200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'base_salary' => 6000000,
                'fix_allowance' => 1200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
