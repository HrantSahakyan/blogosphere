<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        //fetch 6 posts from database which are active and latest
        $posts = Post::where('active',1)->orderBy('updated_at','desc')->paginate(6);
        //return home.blade.php template from resources/views folder
//        dd($posts);
        return view('read-blog')->with('posts',$posts);
    }
    public function theme($theme)
    {
        //fetch 6 posts from database which are active and latest
        $posts = Post::where('active',1)->where('theme',$theme)->orderBy('updated_at','desc')->paginate(6);
        //return home.blade.php template from resources/views folder
//        dd($posts);
        return view('read-blog')->with('posts',$posts);
    }
    public function showPost($slug)
    {
        $post = Post::where('slug',$slug)->where('active',1)->get()->first();
        $last_posts = Post::where('theme',$post->theme)->where('active',1)->where('slug','<>',$slug)->orderBy('updated_at','desc')->take(4)->get();
        return view('article')->with('post',$post)->with('last_posts',$last_posts);
    }

    public function random()
    {
        $post = Post::where('active',1)->get()->shuffle()->first();
        return redirect('article/' . $post->slug);
    }
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->theme = $request->input('theme');
        $post->slug = Str::slug($post->title);
        $post->active = true;
        $post->author_id = $request->user()->id;
        $post->save();
        $post->slug = Str::slug($post->title) . '-' . $post->id;
        $post->save();
        return view('add_image');

//        return redirect('/add/image');
    }

    public function edit($slug)
    {
        $post = Post::where('slug',$slug)->where('author_id',Auth::user()->id)->get()->first();
        if($post === null){
            $message = 'Please, choose your article for editing.';
            return redirect('/profile')->with('message-error',$message);
        }
        return view('/edit')->with('post',$post);
//        return redirect('edit');
    }

    public function update($slug, PostRequest $request)
    {
        $id = Post::where('slug',$slug)->get()->first()->id;
        $post = DB::table('posts')
            ->where('slug', $slug)
            ->where('active',1)
            ->where('author_id',Auth::user()->id)
            ->update(['title' => $request->title,
                      'body' => $request->body,
                      'slug' => Str::slug($request->title) . '-' . $id,
                      'theme' => $request->theme,
                      'updated_at' => date("Y-m-d H:i:s")
                    ]);
        $message = 'Your article updated successfully.';
        return redirect('/profile')->with('message-success',$message);
    }
    public function delete($slug)
    {
            $post = DB::table('posts')
                ->where('slug', $slug)
                ->where('active',1)
                ->where('author_id',Auth::user()->id)
                ->update(['active' => false]);
            if($post == 1){
                $message = 'Your article deleted successfully.';
                return redirect('profile')->with('message-success',$message);
            }
            $message = 'You can\'t delete this article.';
            return redirect('profile')->with('message-error',$message);
    }
}
