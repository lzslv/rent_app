<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $name = 'Посты';
        return view('admin.post.create', compact('name'));
    }

}
