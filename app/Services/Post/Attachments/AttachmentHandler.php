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
final class AttachmentHandler
{
    /**
     * @param array $attachments
     * @param int $postId
     * @return void
     */
    public function savePictures(array $pictures, int $postId): void
    {
        $picturesPaths = [];

        foreach ($pictures as $picture) {
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
     * @param array $updatedPictures
     * @param int $postId
     * @return void
     */
    public function updatePictures(array $updatedPictures, int $postId): void
    {
        $pictures = Picture::where('post_id', $postId)->get();

        foreach ($updatedPictures as $key => $updatedPicture) {
            if ($updatedPicture) {
                $filePathExploded = explode('/', $pictures[$key]->data);
                $fileName = end($filePathExploded);

                Storage::putFileAs('public/pictures/', $updatedPicture, $fileName);
            }
        }
    }

    /**
     * @param string $documentPath
     * @param UploadedFile|null $document
     * @return void
     */
    public function updateDocument(string $documentPath, ?UploadedFile $document = null)
    {
        if ($document) {
            $filePathExploded = explode('/', $documentPath);
            $fileName = end($filePathExploded);

            Storage::putFileAs('public/documents/', $document, $fileName);
        }
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
