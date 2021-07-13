<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')
            ->paginate(6);
        return view('read-blog', compact('posts',));
    }

    public function theme($theme)
    {
        abort_if(!Post::whereTheme($theme)->exists(), 404);
        $posts = Post::whereTheme($theme)
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('read-blog', compact('posts'));
    }

    public function showPost($slug)
    {
        abort_if(!Post::whereSlug($slug)->exists(), 404);
        $post = Post::whereSlug($slug)
            ->get()
            ->first();

        $last_posts = Post::whereTheme($post->theme)
            ->where('slug','<>', $slug)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();
        return view('article', compact('post', 'last_posts'));
    }

    public function random()
    {
        $post = Post::all()->shuffle()->first();
        return redirect('article/' . $post->slug);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        if (Post::whereSlug($slug = Str::slug($data['title']))->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $data['slug'] = $slug;
        $data['author_id'] = Auth::id();
        Post::create($data);
        $image = new Image();
        $image->imageable_id = Post::latest()->first()->id;
        $image->imageable_type = 'post';
        $image->filename = $request->theme . '.png';
        $image->save();
        return view('add_image');
    }
    public function incrementSlug($slug) {
        $original = $slug;
        $count = 1;
        while (Post::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }
    public function edit($slug)
    {
        abort_if(!Post::whereSlug($slug)->exists(), 404);

        $post = Post::whereSlug($slug)
            ->whereAuthor_id(Auth::id())
            ->first();
        return view('/edit', compact('post'));
    }

    public function update($slug, PostRequest $request)
    {
        abort_if(!Post::whereSlug($slug)->exists(), 404);
        $new_slug = Str::slug($request->title);
        if($new_slug != $slug){
            if (Post::whereSlug($new_slug = Str::slug($new_slug))->exists()) {
                $new_slug = $this->incrementSlug($new_slug);
            }
        }
        Post::whereSlug($slug)
            ->whereAuthor_id(Auth::id())
            ->update([
                'title' => $request->title,
                'body' => $request->body,
                'slug' => $new_slug,
                'theme' => $request->theme,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        return redirect('/profile')->with('message_success','Article edited successfully!');
    }

    public function delete($slug)
    {
        abort_if(!Post::whereSlug($slug)->exists(), 404);
        $post = Post::whereSlug($slug)
            ->whereAuthor_id(Auth::id())
            ->delete();
        if ($post == 1) {
            return redirect('profile')->with('message_success','Your article deleted successfully.');
        }
        return redirect('profile')->with('message_error','You can\'t delete this article.');
    }
}
