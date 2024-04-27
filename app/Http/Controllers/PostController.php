<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data['user_id'] = auth()->id();
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        $filePathExploded = explode('/', $post->file);
        $fileName = end($filePathExploded);
        $reviews = Review::where('post_id', $post->id)->get();
        $averageRating = $reviews->avg('rating');

        return view('post.show', compact('post', 'fileName', 'reviews', 'averageRating'));
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
        $data['user_id'] = auth()->id();
        $post->update($data);
        return redirect()->route('post.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function search(Request $request)
    {
        $name = 'Посты';

        $allPosts = $request->get('searched_post_title')
            ? Post::where('title', $request->get('searched_post_title'))->get()
            : Post::get();

        $view = auth()->user()->role === User::ROLE_ADMIN ? 'admin.post.index' : 'post.index';

        return view($view, compact('allPosts', 'name'));
    }

    /**
     * @param string $filename
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(string $filename)
    {
        $disk = Storage::disk('public');
        $filepath = $disk->path('/documents/' . $filename);

        if ($disk->exists('/documents/' . $filename)) {
            return response()->download($filepath, 'document.pdf', [
                'Content-Type: application/pdf'
            ]);
        }

        return back(); // Temporary realization
    }
}
