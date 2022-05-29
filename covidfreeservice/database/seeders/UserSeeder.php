<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'role' => 'worker',
            'study_group' => '',
            'status' => 'healthy',
            'created_at' => now()
        ]);


        DB::table('users')->insert([
            'name' => 'User',
            'surname' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234567'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'role' => 'student',
            'study_group' => 'М00-000',
            'status' => 'healthy',
            'created_at' => now()
        ]);

    }
}
