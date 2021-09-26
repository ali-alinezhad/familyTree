@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6 pl-5">
                <img src="{{ asset($news->pic) }}" height="500" width="100%" id="image">

                    <a href="{{ route('news.delete.image',['lang' => $locale,'news'=> $news->id]) }}">
                        <i class="btn text-danger cil-trash"></i>
                    </a>

            </div>
            <div class="col-md-6 pr-5">
                {{ Form::open(['route'=>['news.update',$locale,$news->id], 'method' => 'put', 'enctype'=>"multipart/form-data"]) }}
                <div>
                    <div class="form-group">
                        <label for="subject">{{ __('translations.subject') }}</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $news->title }}" dir="rtl" required>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"></label>
                        <textarea class="ckeditor form-control" name="description"
                                  id="my_ckeditor" required>{{ $news->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"></label>
                        <input type="file" name="picture" id="picture" onchange="readURL(this);">
                        @error('picture')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('translations.display_other') }}</label>
                        <input type="checkbox" name="status" id="status" @if($news->status) checked @endif>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">{{ __('translations.upload') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('my_ckeditor');
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
    </script>
@endsection
