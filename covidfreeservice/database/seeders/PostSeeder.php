<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Привет!',
            'post_text' => 'Это первый пост в системе mephicovidfreeservice',
            'path_to_img' => '',
            'created_at' => now()
        ]);
    }
}
