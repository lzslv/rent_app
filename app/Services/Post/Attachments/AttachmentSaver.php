<?php

declare(strict_types=1);

namespace App\Services\Post\Attachments;

use App\Models\Picture;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Service for saving post attachments to filesystem and handling records in database
 */
final class AttachmentSaver
{
    /**
     * @param array $attachments
     * @param int $postId
     * @return void
     */
    public function savePictures(array $attachments, int $postId): void
    {
        $picturesPaths = [];

        foreach ($attachments as $picture) {
            $pictureFilename = $postId . '_' .$picture->getClientOriginalName();
            Storage::putFileAs('public/pictures/', $picture, $pictureFilename);
            $picturesPaths[] = '/storage/pictures/' . $pictureFilename;
        }

        Picture::insert([
            ['data' => $picturesPaths[0], 'main_picture' => 1, 'post_id' => $postId],
            ['data' => $picturesPaths[1], 'main_picture' => 0, 'post_id' => $postId],
            ['data' => $picturesPaths[2], 'main_picture' => 0, 'post_id' => $postId]
        ]);
    }

    /**
     * @param UploadedFile $document
     * @return string
     */
    public function saveDocument(UploadedFile $document): string
    {
        $documentFileName = uniqid() . '_' . $document->getClientOriginalName();
        Storage::putFileAs('public/documents/', $document, $documentFileName);

        return 'storage/documents/' . $documentFileName;
    }

    /**
     * @param Post $post
     * @return void
     */
    public function deletePictures(Post $post): void
    {
        $pictures = Picture::where('post_id', $post->id)->get();

        foreach ($pictures as $picture) {
            Storage::delete(str_replace('storage', 'public', $picture->data));
            $picture->delete();
        }
    }

    /**
     * @param string $filepath
     * @return void
     */
    public function deleteDocument(string $filepath): void
    {
        Storage::delete(str_replace('storage', 'public', $filepath));
    }
}
