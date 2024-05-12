<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->truncate();

        DB::table('appointments')->insert([
            [
                'date' => '2024-04-29',
                'note' => 'Заявка на просмотр',
                'user_id' => 1,
                'post_id' => 3,
                'approved' => 1
            ],
            [
                'date' => '2024-04-25',
                'note' => 'Заявка на просмотр 1',
                'user_id' => 1,
                'post_id' => 2,
                'approved' => 1
            ],
            [
                'date' => '2024-04-22',
                'note' => 'Заявка на просмотр 2',
                'user_id' => 3,
                'post_id' => 2,
                'approved' => 0
            ]
        ]);
    }
}
