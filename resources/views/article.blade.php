@extends('layouts.app')
@section('title') Article @endsection
@section('section1')
<section>
    <div class="container">
        <div class="article-single ">
            <h3 class="title-blue text-center">{{$post->title}}</h3>
            <p>{{$post->body}}</p>
            <div class="article-single-image">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    @foreach($post->postImages as $index => $image)
                                @if($index == 0)
                                    <div class="carousel-item active">
                                        <img  src="/storage/uploads/{{$image->filename}}" alt="{{$image->filename}}">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img  src="/storage/uploads/{{$image->filename}}" alt="{{$image->filename}}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @if(count($post->postImages) > 1)
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                    </div>
            </div>
            <address class="text-right font-italic">
                Author:
                <img src="/storage/uploads/{{$post->author->getProfilepictureFilenameAttribute->filename}}" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                {{ $post->author->getFullName() }} <br>
                Last edited at: {{$post->updated_at}} <br>
                Theme: <a href="../read/{{$post->theme}}">{{$post->theme}}</a>
            </address>
            <div class="article-comments">
                <div class="comments">
                    @if(count($post->postComments) == 0)
                        <p>Be first to add comment!</p>
                    @endif
                    @foreach($post->postComments as $comment)
                        <div class="single-comment">
                            <div class="user-author-info">
                                <img src="/storage/uploads/{{$comment->author->getProfilepictureFilenameAttribute->filename}}" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                                <span>{{$comment->author->getFullName()}}, {{$comment->created_at}}</span>
                            </div>
                            <div class="single-comment-text">{{$comment->comment_text}}</div>
                        </div>

                    @endforeach
                </div>
                <form action="/post/comment/{{$post->slug}}" method="post">
                    @csrf
                    <textarea name="comment_text" id="comment" placeholder="Add comment" class=" @error('comment_text') is-invalid @enderror " rows="4"></textarea>
                    @error('comment_text')
                    <span class="invalid-feedback mt-2 mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="submit" value="Comment" id="add-comment" name="add_comment">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('section2')
    <section class="read-also mt-5">
        <div class="container">
            <h3 class="title-blue text-center">Read also</h3>
            <div class="read-also-articles">
            @foreach($last_posts as $last_post)
                    <div class="read-also-article">
                        <a href="../article/{{$last_post->slug}}"><h3 class="text-center">{{$last_post->title}}</h3></a>
                        <p>{{$last_post->body}}</p>
                        <img src="/storage/uploads/{{$last_post->postImages->first()->filename}}">
                        <address class="text-right font-italic">
                            Author:
                            <img src="/storage/uploads/{{$post->author->getProfilepictureFilenameAttribute->filename}}" class="profile_picture_small" alt="prof pic" width=30" height="30" >
                            {{$last_post->author->getFullname()}} <br>
                            Last edited at: {{$last_post->updated_at}} <br>
                            Theme: <a href="../read/{{$last_post->theme}}">{{$last_post->theme}}</a>
                        </address>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
