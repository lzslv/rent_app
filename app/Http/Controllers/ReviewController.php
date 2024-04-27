<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id();
        $postId = $request->route('post');

        $existingReview = Review::where('user_id', $userId)
            ->where('post_id', $postId)
            ->exists();

        // Если отзыв уже существует, возвращаем ошибку
        if ($existingReview) {
            return redirect()->route('post.show', ['post' => $postId])->with('error', 'Вы уже добавили отзыв к этому посту.');
        }

        $data = request()->validate([
            'text' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);
        $data['user_id'] = auth()->id();
        $data['post_id'] = $request->route('post');

        Review::create($data);
        return redirect()->route('post.show', ['post' => $data['post_id']])->with('success', 'Вы добавили отзыв к посту.');
    }

    public function edit(Post $post, Review $review)
    {
        return view('post.review.edit', compact('post', 'review'));
    }

    public function update(Post $post, Review $review, Request $request)
    {
        $data = request()->validate([
            'text' => 'string',
            'rating' => 'required|integer|between:1,5',
        ]);
        $data['user_id'] = $post->user_id;
        $data['post_id'] = $post->id;

        $review->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post, Review $review, Request $request)
    {

        $review->delete();
        return redirect()->route('post.show', $post->id);
    }
}
