<?php

namespace App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $name = 'Посты';
        $postCreatingFormData = $request->all();

        //dd($postCreatingFormData['picture']->getClientOriginalName());

        /*$data = request()->validate([
            'title' => 'string',
            'type' => 'string',
            'rooms' => 'int',
            'size' => 'int',
            'price' => 'int',
            'description' => 'string',
            'picture' => 'string',
            'file' => 'string',
            'region' => 'string',
            'city' => 'string',
            'address' => 'string',
            'landlord_email' => 'string',
            'landlord_phone' => 'int',
        ]);*/

        $picture = $postCreatingFormData['picture'];
        $pictureFilename = $picture->getClientOriginalName();

        $pdfFile = $postCreatingFormData['file'];
        $pdfFilename = $pdfFile->getClientOriginalName();

        Storage::putFileAs('storage/pictures/', $picture, $pictureFilename);
        Storage::putFileAs('storage/documents/', $pdfFile, $pdfFilename);

        $postCreatingFormData['picture'] = '/storage/pictures/' . $pictureFilename;
        $postCreatingFormData['file'] = '/storage/documents/' . $pdfFilename;
        $postCreatingFormData['user_id'] = Auth::user()->id;

        Post::create($postCreatingFormData);

        return redirect()->route('admin.post', compact('name'));
    }

}
