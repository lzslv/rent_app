<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        $name = 'Личный кабинет';

        return view('user.index', compact('posts', 'name'));
    }
}
