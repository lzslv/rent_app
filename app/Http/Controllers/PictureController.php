<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Post;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;


class PictureController extends Controller
{
    public function create(Post $post)
    {
        return view('post.picture.create', compact('post'));
    }


    public function store(Post $post)
    {
        $pictures = \request()->pictures;
        $mainPictureIndex = \request()->input('main_picture');

        foreach ($pictures as $index => $picture) {
            $validatedData = [
                'data' => $picture,
            ];

            $validationRules = [
                'data' => 'required|url',
            ];

            $validator = \Validator::make($validatedData, $validationRules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validatedData['post_id'] = $post->id;

            if ($mainPictureIndex !== null && $mainPictureIndex == $index) {
                $validatedData['main_picture'] = true;
            } else {
                $validatedData['main_picture'] = false;
            }

            Picture::create($validatedData);
        }

        return redirect()->route('post.index');
    }

}
