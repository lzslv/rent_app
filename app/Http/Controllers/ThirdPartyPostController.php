<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Post\KufarScrapper;
use Illuminate\Http\Request;

class ThirdPartyPostController extends Controller
{
    private const NAME = 'Сторонние объявления';

    public function index(KufarScrapper $kufarScrapper)
    {
        $kufarPosts = $kufarScrapper->parse();

        return view('home.kufar')->with('kufarPosts', $kufarPosts)->with('name', self::NAME);
    }
}
