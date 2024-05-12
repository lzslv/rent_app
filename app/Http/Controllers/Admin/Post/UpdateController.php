<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Services\Post\Attachments\AttachmentHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(Post $post, Request $request, AttachmentHandler $attachmentHandler)
    {
        $name = 'Посты';
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

        $data['user_id'] = Auth::user()->id;
        $post->update($data);

        return redirect()->route('admin.post.show', compact('post', 'name'));
    }
}
