<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'NIP' => '12345',
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'birth_date' => '1990-01-01',
                'gender' => 'male',
                'religion' => 'Islam',
                'phone_number' => '08123456789',
                'last_education' => 'Bachelor of Science',
                'address' => 'Jl. Jendral Sudirman No. 123',
                'hire_date' => '2020-01-01',
                'hire_date_end' => '2025-12-31',
                'position' => 'Manager',
                'employee_type' => 'monthly',
                'bpjs' => 'bpjs',
                'rfid_number' => '12345',
                'is_active' => true,
                'department_id' => 1, 
                // 'salary_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIP' => '54321',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'birth_date' => '1995-05-15',
                'gender' => 'female',
                'religion' => 'Kristen',
                'phone_number' => '08765432100',
                'last_education' => 'Master of Business Administration',
                'address' => 'Jl. Gatot Subroto No. 456',
                'hire_date' => '2021-03-15',
                'hire_date_end' => '2025-12-31',
                'position' => 'Senior',
                'employee_type' => 'monthly',
                'bpjs' => 'bpjs',
                'rfid_number' => '78987897',
                'is_active' => true,
                'department_id' => 2, 
                // 'salary_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIP' => '67890',
                'name' => 'John Smith',
                'email' => 'abc@gmail.com',
                'birth_date' => '1990-01-01',
                'gender' => 'female',
                'religion' => 'Kristen',
                'phone_number' => '08765432100',
                'last_education' => 'Master of Business Administration',
                'address' => 'Jl. Gatot Subroto No. 456',
                'hire_date' => '2021-03-15',
                'hire_date_end' => '2025-12-31',
                'position' => 'Senior',
                'employee_type' => 'daily',
                'bpjs' => 'no_bpjs',
                'rfid_number' => '7897897',
                'is_active' => true,
                'department_id' => 2, 
                // 'salary_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
