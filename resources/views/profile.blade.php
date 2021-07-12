@extends('layouts.app')
@section('title')My profile @endsection

@section('section1')
    <section class="my-page mt-3">
        <div class="container">
            <h1 class="text-center">My page</h1>
            <div class="profile ">
                <div class="prof-pic">
                    <img src="/storage/uploads/{{Auth::user()->getProfilepictureFilenameAttribute->filename}}" alt="prof pic" width="200" height="200">
                </div>
{{--                {{}}--}}
                <div class="prof-info">
                    <h4>{{Auth::user()->full_name}}</h4>
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
        @if(session('message_success'))
            <div class="alert alert-success success-message">
                {{ session()->get('message_success') }}
            </div>
        @endif
        @if(session('message_error'))
            <div class="alert alert-danger success-message">
                {{ session()->get('message_error') }}
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
                        <img src="/storage/uploads/{{ $post->postImages->first()->filename}}">
                        <address class="text-right font-italic">
                            Author:
{{--                            @if(Auth::user()->userImage === null){{'profile.png'}}@else{{dd(4444)}}@endif--}}
                            <img src="/storage/uploads/@if(Auth::user()->getProfilepictureFilenameAttribute === null){{'profile.jpg'}}@else{{Auth::user()->getProfilepictureFilenameAttribute->filename}}@endif" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                            {{Auth::user()->getFullName()}} <br>
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
        {{ $posts->links() }}
    </div>
@endsection

