<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;

use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke()
    {
        $name = 'Посты';
        $data = request()->validate([
            'title' => 'string',
            'type' => 'string',
            'rooms' => 'int',
            'size' => 'int',
            'price' => 'int',
            'description' => 'string',
            'picture' => 'string',
            'file' => 'string',
            'region' => 'string',
            'city' => 'string',
            'address' => 'string',
            'landlord_email' => 'string',
            'landlord_phone' => 'int',
        ]);
        Post::create($data);
        return redirect()->route('admin.post', compact('name'));
    }

}
