<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<20; $i++) {
            DB::table('comments')->insert([
                'post_id' => rand(1, 10),
                'user_id' => rand(1, 10),
                'comment_text' => Str::random(10),
                'created_at' => now()
            ]);
        }
    }
}
