<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        $name = 'Личный кабинет';

        return view('user.show', compact('posts', 'user'));
    }
}
