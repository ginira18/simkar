<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            SalarySeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
