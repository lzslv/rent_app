<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class StoreController extends Controller
{
    public function __invoke()
    {
        $name = 'Пользователи';
        $data = request()->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
        ]);
        User::create($data);
        return redirect()->route('admin.user', compact('name'));
    }

}
