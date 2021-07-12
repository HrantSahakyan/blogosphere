@extends('layouts.app')
@section('title')Add blog @endsection
@section('section1')
    <section class="add-article">
        <div class="container ">
            <h1 class="text-center title-blue">Add blog</h1>
        </div>
    </section>
@endsection
@section('section2')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add blog') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/add/image">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>

                                <div class="col-md-6">
                                    <textarea name="body" id="body" class="form-control @error('title') is-invalid @enderror" value="{{ old('body') }}" required autocomplete="body" autofocus></textarea>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="theme" class="col-md-4 col-form-label text-md-right">{{ __('Theme') }}</label>

                                <div class="col-md-6">
                                    <select id="theme" type="text" class="form-control @error('theme') is-invalid @enderror" name="theme" value="{{ old('theme') }}" required autocomplete="theme" autofocus>
                                        <option value="science">Science</option>
                                        <option value="films">Films</option>
                                        <option value="music">Music</option>
                                        <option value="books">Books</option>
                                        <option value="sport">Sport</option>
                                        <option value="education">Education</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('theme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Add images') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" value="{{ old('images') }}" autocomplete="images" autofocus multiple>--}}
{{--                                    @error('files')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
