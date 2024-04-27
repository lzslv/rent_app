<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Models\Post;

final class Sorter
{
    /**
     * @var array
     */
    private static array $fieldsWithDirections;

    /**
     * @param string $field
     * @param string $direction
     * @return mixed
     */
    public function getSortedData(string $field, string $direction): mixed
    {
        return Post::orderBy($field, $direction)->get();
    }

    /**
     * @param string $field
     * @param string $direction
     * @return array
     */
    public function getNewDirections(string $field, string $direction): array
    {
        self::$fieldsWithDirections[$field] = $direction === 'asc' ? 'desc' : 'asc';

        return self::$fieldsWithDirections;
    }
}
