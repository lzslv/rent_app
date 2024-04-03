<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user)
    {
        $name = 'Пользователи';
        $roles = User::getRoles();
        return view('admin.user.edit', compact('user', 'name', 'roles'));
    }

}
