<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param int $post
     */
    public function handle(Request $request, Closure $next, int $post): Response
    {
        $postId = $request->route('post'); // Получаем id поста из маршрута
        $post = Post::findOrFail($postId); // Находим пост

        // Проверяем, принадлежит ли пост текущему пользователю
        if ($post->user_id !== auth()->user()->id) {
            abort(403, 'У вас нет прав на удаление этого поста.');
        }


        return $next($request);
    }
}
