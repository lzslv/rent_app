<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;

use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $name = 'Посты';

        return view('admin.post.show')->with('name', $name)->with('post', $post)->with('pictures', $post->pictures);
    }

}
