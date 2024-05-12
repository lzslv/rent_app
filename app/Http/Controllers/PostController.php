<?php

namespace App\Http\Controllers;

use App\Helpers\FilenameExtractor;
use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use App\Services\Post\Attachments\AttachmentHandler;
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

    public function store(Request $request, AttachmentHandler $attachmentHandler) {
        /*$data = request()->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1',
            'size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'file' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'landlord_email' => 'required|email|max:255',
            'landlord_phone' => 'required|string|max:255',
        ]);*/

        $data = $request->except(['picture1', 'picture2', 'picture3', 'file']);
        $pictures = [$request->file('picture1'), $request->file('picture2'), $request->file('picture3')];
        $document = $request->file('file');
        $data['user_id'] = auth()->id();

        $data['file'] = $attachmentHandler->saveDocument($document);
        $post = Post::create($data);
        $attachmentHandler->savePictures($pictures, $post->id);

        return redirect()->route('post.index', compact('post'));
    }

    public function show(Post $post, FilenameExtractor $filenameExtractor)
    {
        $filename = $filenameExtractor->extract($post->file);
        $reviews = Review::where('post_id', $post->id)->get();

        return view('post.show')
            ->with('post', $post)
            ->with('fileName', $filename)
            ->with('reviews', $reviews)
            ->with('averageRating', $reviews->avg('rating'))
            ->with('pictures', $post->pictures);
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post, Request $request, AttachmentHandler $attachmentHandler)
    {
        /*$data = request()->validate([
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
        ]);*/
        $data = $request->except(['picture1', 'picture2', 'picture3', 'file']);
        $pictures = [$request->file('picture1'), $request->file('picture2'), $request->file('picture3')];
        $document = $request->file('file');

        $attachmentHandler->updatePictures($pictures, $post->id);
        $attachmentHandler->updateDocument($post->file, $document);

        $data['user_id'] = auth()->id();
        $post->update($data);
        return redirect()->route('post.show', $post);
    }

    public function destroy(Post $post, AttachmentHandler $attachmentHandler)
    {
        $attachmentHandler->deletePictures($post);
        $attachmentHandler->deleteDocument($post->file);
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

    public function recommendations()
    {
        $recommendedPosts = Post::get();

        return view('home.recommendations')->with('name', 'Рекомендации')->with('recommendedPosts', $recommendedPosts);
    }
}
