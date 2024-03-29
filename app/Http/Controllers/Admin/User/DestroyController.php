<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        $name = 'Пользователи';
        $user->delete();
        return redirect()->route('admin.user.index', compact('name'));
    }

}
