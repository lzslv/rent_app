<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        $roles = User::getRoles();
        $name = 'Пользователи';
        return view('admin.user.index', compact('users', 'name', 'roles'));
    }

}
