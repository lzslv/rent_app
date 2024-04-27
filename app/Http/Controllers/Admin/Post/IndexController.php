<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Post\Sorter;

class IndexController extends Controller
{
    private const NAME = 'Посты';

    public function __construct(
        private Sorter $sorter
    ) {
    }

    public function index()
    {
        $allPosts = Post::get();

        return view('admin.post.index')->with('allPosts', $allPosts)->with('name', self::NAME);
    }

    public function sort(string $field, string $direction)
    {
        return view('admin.post.index')
            ->with('allPosts', $this->sorter->getSortedData($field, $direction))
            ->with('name', self::NAME)
            ->with('directions', $this->sorter->getNewDirections($field, $direction));
    }
}
