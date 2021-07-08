<?php

namespace App\Http\Controllers;

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
        //TODO what is the scope in laravel, who am i
        $posts = Post::active()
            ->orderBy('updated_at', 'desc')
            ->paginate(6);
        //return home.blade.php template from resources/views folder
//        dd($posts);
        //FIXME all with to compact, check edit method
        return view('read-blog')->with('posts', $posts);
    }

    public function theme($theme)
    {
        //fetch 6 posts from database which are active and latest
        $posts = Post::where('active', 1)
            ->whereTheme($theme)
            ->orderByDesc('updated_at')
            ->paginate(6);
        //return home.blade.php template from resources/views folder
//        dd($posts);
        return view('read-blog')->with('posts', $posts);
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)
            ->active()
            ->get()
            ->first();

        $last_posts = Post::where('theme', $post->theme)
            ->active()
            ->where('slug', '<>', $slug)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();
        return view('article')->with('post', $post)->with('last_posts', $last_posts);
    }

    public function random()
    {
        $post = Post::where('active', 1)->get()->shuffle()->first();
        return redirect('article/' . $post->slug);
    }

    public function store(PostRequest $request)
    {
        //TODO by default active is true, make it in migration level
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $data['active'] = true;
        $data['author_id'] = Auth::id();
        Post::create($data);

        return view('add_image');
    }

    public function edit($slug)
    {
        abort_if(!Post::where('slug', $slug)->exists(),404);

        $post = Post::where('slug', $slug)
            ->where('author_id', Auth::id())
            ->first();

        return view('/edit', compact('post'));
    }

    public function update($slug, PostRequest $request)
    {
        $id = Post::where('slug', $slug)->get()->first()->id;
        //TODO active inactive checkbox
        Post::whereSlug($slug)
            ->active()
            ->where('author_id', Auth::id())
            ->update([
                'title' => $request->title,
                'body' => $request->body,
                'slug' => Str::slug($request->title) . '-' . $id,
                'theme' => $request->theme,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        $message = 'Your article updated successfully.';
        return redirect('/profile')->with('message-success', $message);
    }

    public function delete($slug)
    {
        //TODO soft delete for all posts
        //FIXME DB::table to Model name
        $post = DB::table('posts')
            ->where('slug', $slug)
            ->active()
            ->where('author_id', Auth::user()->id)
            ->update(['active' => false]);
        if ($post == 1) {
            $message = 'Your article deleted successfully.';
            return redirect('profile')->with('message-success', $message);
        }
        $message = 'You can\'t delete this article.';
        return redirect('profile')->with('message-error', $message);
    }
}
