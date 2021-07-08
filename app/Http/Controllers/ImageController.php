<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function upload(ImageRequest $request)
    {
        $request->validate([
            'images[]' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
        $post_id = DB::table('posts')->latest()->first()->id;
        if ($request->hasfile('images')) {
            foreach ($request->allFiles()['images'] as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
                $image = new Image();
                $image->filenames = $name;
                $image->post_id = $post_id;
                $image->save();
            }
            return redirect('/profile')->with('message-success', 'Blog has successfully added!');
        } else {
            $image = new Image();
            $post = DB::table('posts')->where('id', $post_id)->get();
            $theme = $post[0]->theme;
            $image->filenames = $theme . '.png';
            $image->post_id = $post_id;
            $image->save();
            return redirect('/profile')->with('message-success', 'Blog has successfully added!');
        }
    }
}
