@extends('layouts.app')
@section('title')Read blog @endsection

@section('section1')
    <section class="articles">
        <div class="container">
            <h1 class="text-center">Read articles</h1>
            <div class="blogs">
            @foreach( $posts->items() as $index => $post )
                <div class="blog">
                    <a href="../article/{{$post->slug}}"><h3 class="text-center">{{$post->title}}</h3></a>
                    <p>{{$post->body}}</p>
                    <img src="/storage/uploads/{{$post->postImages->first()->filename}}">
                    <address class="text-right font-italic">
                        Author:

                        <img src="/storage/uploads/@if($post->author->getProfilepictureFilenameAttribute === null){{'profile.jpg'}}@else{{$post->author->getProfilepictureFilenameAttribute->filename}}@endif" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                        {{$post->author->getFullName()}} <br>
                        Last edited at: {{$post->updated_at}} <br>
                        Theme: <a href="../read/{{$post->theme}}">{{$post->theme}}</a>
                    </address>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('section2')
        <div class="d-flex justify-content-center pagination">
            {{ $posts->links() }}
        </div>
@endsection
{{--{{dd(with($posts))}}--}}
