<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        $name = 'Пользователи';

        return view('admin.user.show', compact('user', 'name'));
    }

}
