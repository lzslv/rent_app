<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;

use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $allPosts = Post::all();
        $name = 'Посты';
        return view('admin.post.index', compact('allPosts', 'name'));
    }

}
