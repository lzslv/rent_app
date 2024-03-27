<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();

        return view('post.index', compact('allPosts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'type' => 'string',
            'rooms' => 'int',
            'size' => 'int',
            'price' => 'int',
            'description' => 'string',
            'picture' => 'string',
            'file' => 'string',
            'region' => 'string',
            'city' => 'string',
            'address' => 'string',
            'landlord_email' => 'string',
            'landlord_phone' => 'int',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post) {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'type' => 'string',
            'rooms' => 'int',
            'size' => 'int',
            'price' => 'int',
            'description' => 'string',
            'picture' => 'string',
            'file' => 'string',
            'region' => 'string',
            'city' => 'string',
            'address' => 'string',
            'landlord_email' => 'string',
            'landlord_phone' => 'int',
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
