@extends('layouts.app')
@section('title') Home @endsection
@section('nav-bg') bg-transparent @endsection
@section('header-content')
    <div class="context">
        <h1 id="contextH1">Welcome to Blogosphere!</h1>
        <div class="wrapper">
            <button onclick="scroll_start()">
                Get started
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    <div class="area" >
        <ul class="circles">
            <li class="text-center align-content-center bg-transparent"><span>Education</span></li>
            <li class="text-center align-content-center"><span>Sport</span></li>
            <li class="text-center align-content-center "><span>Science</span></li>
            <li class="text-center align-content-center bg-transparent"><span>Music</span></li>
            <li class="text-center align-content-center "><span>Books</span></li>
            <li class="text-center align-content-center bg-transparent"><span>Films</span></li>
            <li class="text-center align-content-center"><span>Music</span></li>
            <li class="text-center align-content-center "><span>Science</span></li>
            <li class="text-center align-content-center bg-transparent"><span>Sport</span></li>
            <li class="text-center align-content-center"><span>Education</span></li>
            <li class="text-center align-content-center "><span>Films</span></li>
        </ul>
        @endsection
        @section('section1')
            <section class="we-write" id="we-write">
                <div class="container">
                    <h1>We Write About</h1>
                    <div class="themes">
                        <div class="theme">
                            <img src="{{asset('images/science.png')}}" alt="science image logo">
                            <a href="#"><h4>Science</h4></a>
                        </div>
                        <div class="theme">
                            <img src="{{asset('images/films.png')}}" alt="film image logo">
                            <a href="#"><h4>Films</h4></a>
                        </div>
                        <div class="theme">
                            <img src="{{asset('images/music.png')}}" alt="music image logo">
                            <a href="#"><h4>Music</h4></a>
                        </div>
                        <div class="theme">
                            <img src="{{asset('images/books.png')}}" alt="book image logo">
                            <a href="#"><h4>Books</h4></a>
                        </div>
                        <div class="theme">
                            <img src="{{asset('images/sport.png')}}" alt="sport image logo">
                            <a href="#"><h4>Sport</h4></a>
                        </div>
                        <div class="theme">
                            <img src="{{asset('images/education.png')}}" alt="education image logo">
                            <a href="#"><h4>Education</h4></a>
                        </div>
                    </div>
                </div>
            </section>
@endsection

