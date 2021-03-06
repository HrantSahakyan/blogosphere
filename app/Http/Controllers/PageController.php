<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        return view('add');
    }
    public function profile()
    {
        //fetch 6 posts from database which are active and latest
        $posts = Post::where('active',1)->where('author_id',Auth::user()->id)->orderBy('updated_at','desc')->paginate(6);
        return view('profile')->with('posts',$posts);
    }
}
