<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke()
    {
        $name = 'Пользователи';
        $data = request()->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
            'role' => 'int',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.user', compact('name'));
    }

}
