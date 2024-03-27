<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();

        return view('home', compact('allPosts'));
    }
}
