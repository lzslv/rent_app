<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $name = 'Пользователи';
        return view('admin.user.create', compact('name'));
    }

}
