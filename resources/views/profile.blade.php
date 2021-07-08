@extends('layouts.app')
@section('title')My profile @endsection

@section('section1')
    <section class="my-page mt-3">
        <div class="container">
            <h1 class="text-center">My page</h1>
            <div class="profile ">
                <div class="prof-pic">
                    <img src="/storage/profile_pictures/{{Auth::user()->image}}" alt="prof pic" width="200" height="200">
                </div>
                <div class="prof-info">
                    <h4>{{Auth::user()->name .' '.Auth::user()->lastname}}</h4>
                    <h4>In Blogosphere from: {{Auth::user()->created_at}}</h4>
                    <h4>Created articles: {{$posts->total()}}</h4>
                    <form action="{{route('home-upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="image">Add image</label>
                        <input type="file" name="image" id="image"><br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
        @if(session()->has('message-success'))
            <div class="alert alert-success success-message">
                {{ session()->get('message-success') }}
            </div>
        @endif
        @if(session()->has('message-error'))
            <div class="alert alert-danger success-message">
                {{ session()->get('message-error') }}
            </div>
        @endif
    </section>

@endsection
@section('section2')
    <section class="articles">
        <div class="container">
            <h1 class="text-center">Read articles</h1>
            <div class="blogs">
                @foreach( $posts->items() as $post )
                    <div class="blog">
                        <a href="article/{{$post->slug}}"><h3 class="text-center">{{$post->title}}</h3></a>
                        <p>{{$post->body}}</p>
                        <img src="/storage/uploads/{{ $post->images->first()->filenames}}">
                        <address class="text-right font-italic">
                            Author:<img src="/storage/profile_pictures/{{Auth::user()->image }}" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                            {{DB::table('users')->where('id',$post->author_id)->get()->first()->name . ' ' . DB::table('users')->where('id',$post->author_id)->get()->first()->lastname}} <br>
                            Last edited at: {{$post->updated_at}} <br>
                            Theme: <a href="read/{{$post->theme}}">{{$post->theme}}</a>
                        </address>
                        <div class="delete-edit float-right">
                            <a class="edit" href="edit/{{$post->slug}}"><i class="fa fa-2x fa-pencil"></i></a>
                            <a class="delete" href="edit/delete/{{$post->slug}}"><i class="fa fa-2x fa-trash"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center pagination">
        {{ with($posts)->links() }}
    </div>
@endsection

