<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = \auth()->user();
        $posts = $user->posts()->get();

        $appointments = $user->appointments()->get();
        $postKeys = Post::pluck('id')->toArray();
        $allPosts = Post::all()->keyBy('id');
        // Передаем данные в представление

        $postIds = $posts->pluck('id');

        $notApprovedAppointments = Appointment::whereIn('post_id', $postIds)
            ->get();
        return view('user.index', compact('posts', 'user', 'appointments', 'allPosts', 'notApprovedAppointments'));
    }
}
