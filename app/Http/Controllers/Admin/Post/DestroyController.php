<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Services\Post\Attachments\AttachmentHandler;

class DestroyController extends Controller
{
    public function __invoke(Post $post, AttachmentHandler $attachmentHandler)
    {
        $name = 'Посты';

        $attachmentHandler->deletePictures($post);
        $attachmentHandler->deleteDocument($post->file);
        $post->delete();

        return redirect()->route('admin.post', compact('name'));
    }
}
