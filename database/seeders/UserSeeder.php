<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 0,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'role' => 1,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'role' => 1,
                'password' => Hash::make('123456')
            ]
        ]);
    }
}
