<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ImageController extends Controller
{
    public function uploadPostImages(ImageRequest $request)
    {
        $request->validate([
            'images[]' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageable_id = Post::latest()->first()->id;

        if ($request->hasfile('images')) {
            Image::whereImageable_id($imageable_id)->delete();
            foreach ($request->allFiles()['images'] as $file) {
                $image = new Image();
                $image->imageable_type = 'post';
                $image->imageable_id = $imageable_id;
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
                $image->filename = $name;
                $image->save();
            }
            return redirect('/profile')->with('message_success','Article created succesfully!');
        }
        return redirect('/profile')->with('message_success','Article created succesfully!');
    }

    public function upload(ImageRequest $request)
    {
        if($request->hasFile('image')){
            $request->validate([
                'images[]' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
            $filename = $request->image->getClientOriginalName();
            $file = $request->file()['image'];
            $file->move(public_path() . '/uploads/', $filename);
            try {
                Image::whereImageable_type('user')->whereImageable_id(Auth::id())->update(['filename'=>$filename]);
                return redirect()->back()->with('message_success','Image updated succesfully!');
            }catch (\Throwable $exception){
                $image = new Image();
                $image->imageable_type = 'user';
                $image->imageable_id = Auth::id();
                $image->save();
                return redirect()->back()->with('message_success','Image added succesfully!');
            }
        }
        else{
            return redirect()->back()->with('message_error','Choose image for changing.');
        }
    }
}
