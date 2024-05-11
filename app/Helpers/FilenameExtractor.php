<?php

declare(strict_types=1);

namespace App\Helpers;

final class FilenameExtractor
{
    /**
     * @param string $filepath
     * @return string
     */
    public function extract(string $filepath): string
    {
        $filePathExploded = explode('/',$filepath);

        return end($filePathExploded);
    }
}
