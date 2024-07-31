<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1, 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'), 
            'roles' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('12345678'), 
            'roles' => 'pegawai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
