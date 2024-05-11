<?php

declare(strict_types=1);

namespace App\Services\Post\Attachments;

use App\Models\Picture;
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
}
