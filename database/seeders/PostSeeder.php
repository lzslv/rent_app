<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->truncate();

        DB::table('posts')->insert([
            [
                'title' => 'Двухкомнатная квартира',
                'type' => 'Квартира',
                'rooms' => 2,
                'size' => 100,
                'price' => 250,
                'description' => Str::random(15),
                'picture' => 'https://www.peredelka.tv/upload/resize_cache/sprint.editor/abe/1024_768_1/img-1617817963-3406-639-open-concept-small-apartment.jpg',
                'file' => 'http://localhost/storage/documents/test.pdf',
                'region' => 'Минск',
                'city' => 'Минск',
                'address' => 'Test address',
                'landlord_email' => 'landlord@gmail.com',
                'landlord_phone' => '+375(29)1111111',
                'likes' => 15,
                'user_id' => 2,
                'is_published' => 1,
                'created_at' => '2024-02-19'
            ],
            [
                'title' => 'Однокомнатная квартира',
                'type' => 'Квартира',
                'rooms' => 1,
                'size' => 55,
                'price' => 200,
                'description' => Str::random(15),
                'picture' => '/storage/pictures/1-studio-kami-img~3ef1b2d1066af28a_4-8974-1-22448fa.jpg',
                'file' => 'http://localhost/storage/documents/test1.pdf',
                'region' => 'Минск',
                'city' => 'Минск',
                'address' => 'Test address1',
                'landlord_email' => 'landlord123@gmail.com',
                'landlord_phone' => '+375(29)1234567',
                'likes' => 7,
                'user_id' => 3,
                'is_published' => 1,
                'created_at' => '2024-04-08'
            ],
        ]);
    }
}
