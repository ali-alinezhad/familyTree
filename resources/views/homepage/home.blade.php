@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6 pl-5">
                <img src="{{ asset($homepage->logo) }}" height="500" width="100%" id="image">

                @if($homepage->logo !== \App\Http\Controllers\HomePageController::LOGO_DEFAULT)
                    <a href="{{ route('homepage.delete.logo',['lang' => $locale,'homepage'=> $homepage->id]) }}">
                        <i class="btn text-danger cil-trash"></i>
                    </a>
                @endif
            </div>
            <div class="col-md-6 pr-5">
                {{ Form::open(['route'=>['homepage.update',$locale], 'method' => 'put', 'enctype'=>"multipart/form-data"]) }}
                <div>
                    <div class="form-group">
                        <label for="subject">Title</label>
                        <input type="text" name="header_title" class="form-control" id="header_title"
                               value="{{ $homepage->header_title }}">
                        @error('header_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="header_des">Description</label>
                        <textarea class="ckeditor form-control" name="header_des"
                                  id="header_des">{{ $homepage->header_des }}</textarea>
                        @error('header_des')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo" onchange="readURL(this);">
                        @error('logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="music">Music</label>
                        <input type="file" name="music" id="music" onchange="readMusicURL(this);">
                        @error('music')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <audio src="../../{{ $homepage->music }}" controls id="musicAudio"></audio>
                    @if($homepage->music)
                        <a href="{{ route('homepage.delete.music',['lang' => $locale]) }}">
                            <i class="btn text-danger cil-trash"></i>
                        </a>
                    @endif

                    <div class="form-group">
                        <label for="subject">About Us Title</label>
                        <input type="text" name="about_us_title" class="form-control" id="about_us_title"
                               value="{{ $homepage->about_us_title }}">
                        @error('about_us_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="about_us_des">About Us Description</label>
                        <textarea class="ckeditor form-control" name="about_us_des"
                                  id="about_us_des">{{ $homepage->about_us_des }}</textarea>
                        @error('about_us_des')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">Upload</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('header_des');
            CKEDITOR.replace('about_us_des');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMusicURL(input) {
            if (input.files && input.files[0]) {
                var readerMusic = new FileReader();
                readerMusic.onload = function (e) {
                    $('#musicAudio').attr('src', e.target.result);
                };
                readerMusic.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
