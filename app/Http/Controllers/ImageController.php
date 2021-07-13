<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\UploadImageRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ImageController extends Controller
{
    public function uploadPostImages(ImageRequest $request)
    {
        $data = $request->validated();
        $imageable_id = Post::latest()->first()->id;

        if ($request->hasfile('images')) {
            Image::whereImageable_id($imageable_id)->delete();
            foreach ($data['images'] as $file) {
                $image = new Image();
                $image->imageable_type = 'post';
                $image->imageable_id = $imageable_id;
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
                $image->filename = $name;
                $image->save();
            }
        }
        return redirect('/profile')->with('message_success', 'Article created succesfully!');
    }

    public function upload(UploadImageRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $filename = $data['image']->getClientOriginalName();
            $file = $data['image'];
            $file->move(public_path() . '/uploads/', $filename);
            Image::whereImageable_type('user')->whereImageable_id(Auth::id())->update(['filename' => $filename]);
            return redirect()->back()->with('message_success', 'Image updated succesfully!');
        }
        return redirect()->back()->with('message_error', 'Choose image for changing.');
    }
}
