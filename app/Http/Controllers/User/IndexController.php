<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(User $user)
    {

        $posts = $user->posts()->get();

        // Передаем данные в представление
        return view('user.show', compact('posts', 'user'));
    }
}
