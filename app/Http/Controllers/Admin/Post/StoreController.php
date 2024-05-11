<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Post\Attachments\DocumentSaver;
use App\Services\Post\Attachments\AttachmentSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(Request $request, AttachmentSaver $attachmentSaver)
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
        $name = 'Посты';
        $postCreatingFormData = $request->except(['picture1', 'picture2', 'picture3', 'file']);

        $pictures = [$request->file('picture1'), $request->file('picture2'), $request->file('picture3')];
        $document = $request->file('file');
        $postCreatingFormData['user_id'] = auth()->id();

        $postCreatingFormData['file'] = $attachmentSaver->saveDocument($document);
        $post = Post::create($postCreatingFormData);
        $attachmentSaver->savePictures($pictures, $post->id);

        return redirect()->route('admin.post', compact('name'));
    }
}
