@extends('layouts.app')
@section('title')Add Image @endsection
@section('section1')
    <section class="add-article">
        <div class="container ">
            <h1 class="text-center title-blue">Add images</h1>
        </div>
    </section>
@endsection
@section('section2')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add images') }} <br> If you don't want add images, just click Add</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('upload')}}" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Add images') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" value="{{ old('images') }}" autocomplete="images" autofocus multiple>
                                    @error('files')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
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
