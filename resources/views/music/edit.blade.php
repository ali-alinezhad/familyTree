@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 pr-5">
                {{ Form::open(['route'=>['music.update',$locale,$music->id], 'method' => 'put', 'enctype'=>"multipart/form-data"]) }}
                <div>
                    <div class="form-group">
                        <label for="subject">{{ __('translations.titles') }}</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $music->title }}"
                              @if($locale === 'fas') dir="rtl" @endif>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"></label>
                        <textarea class="ckeditor form-control" name="description"
                                  id="my_ckeditor">{{ $music->description }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"></label>
                        <input type="file" name="file" id="file">
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('translations.display_other') }}</label>
                        <input type="checkbox" name="status" id="status" @if($music->status) checked @endif>
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
            <div class="col-md-6 pl-5">
                <div class="text-center pt-3">
                    <audio class="text-center" src="{{ asset($music->file) }}" style="height: 30px; width: 170px;"
                           controls>
                    </audio>
                </div>
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
    </script>
@endsection
