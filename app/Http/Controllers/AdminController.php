<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $name = 'Главная';

        return view('admin.index', compact('posts', 'name'));
    }

    public function landlords()
    {
        $name = 'Арендодатели:';
        return view('admin.landlords', compact('name'));
    }

    public function renters()
    {
        $name = 'Арендаторы:';

        return view('admin.renters', compact('name'));
    }

    public function users()
    {
        $name = 'Все пользователи';

        return view('admin.users', compact('name'));
    }
}
