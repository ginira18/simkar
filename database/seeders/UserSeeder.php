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
            'username' => 'admin',
            'password' => Hash::make('jkllkj'), 
            'roles' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'username' => 'pegawai',
            'password' => Hash::make('jkllkj'), 
            'roles' => 'pegawai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
