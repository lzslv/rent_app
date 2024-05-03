<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->truncate();

        DB::table('reviews')->insert([
            [
                'text' => Str::random(10),
                'rating' => rand(1, 5),
                'user_id' => 1,
                'post_id' => 3
            ],
            [
                'text' => Str::random(10),
                'rating' => rand(1, 5),
                'user_id' => 2,
                'post_id' => 2
            ],
            [
                'text' => Str::random(10),
                'rating' => rand(1, 5),
                'user_id' => 1,
                'post_id' => 2
            ]
        ]);
    }
}
