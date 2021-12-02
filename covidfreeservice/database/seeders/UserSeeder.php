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
            'name' => Str::random(10),
            'surname' => Str::random(10),
            'fathername' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'role' => 'worker',
            'study_group' => '',
            'tracker_id' => '',
            'status' => 'healthy',
            'created_at' => now()
        ]);

        for ($i=0; $i<10; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'surname' => Str::random(10),
                'fathername' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => false,
                'role' => 'student',
                'study_group' => 'b0'.$i.'-00'.$i,
                'tracker_id' => '',
                'status' => 'healthy',
                'created_at' => now()
            ]);
        }
    }


}
