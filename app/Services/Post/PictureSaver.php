<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Models\Picture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Service for saving post pictures to filesystem and handling pictures records in database
 */
final class PictureSaver
{
    /**
     * @param array $pictures
     * @param int $postId
     * @return void
     */
    public function save(array $pictures, int $postId): void
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
}
