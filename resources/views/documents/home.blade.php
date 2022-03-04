@php
    ini_set('memory_limit','10240M');
@endphp
@extends('layouts.app')
@section('third_party_stylesheets')

    <style>
        .banner33 {
            background: #a770ef;
            background: -webkit-linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
            background: linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="px-lg-5">
            @if($user->role < 2)
                <div class="row pb-5">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#uploadDocument">
                        {{ __('translations.upload_document') }} <i class="cil-plus"></i>
                    </button>
                </div>
                <div id="uploadDocument" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                {{ __('translations.upload_document') }}
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                {{ Form::open(['route'=>['document.upload',$locale], 'method' => 'put','enctype'=>"multipart/form-data"]) }}
                                <div>
                                    <div class="form-group">
                                        <label for="subject">{{ __('translations.titles') }}</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description"></label>
                                        <textarea class="ckeditor form-control" name="description"
                                                  id="my_ckeditor"></textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="file"></label>
                                        <input type="file" name="file" id="file"
                                               accept="ppt,pptx,doc,docx,pdf,xls,xlsx">

                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">{{ __('translations.display_other') }}</label>
                                        <input type="checkbox" name="status" id="status">
                                        @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            class="btn btn-primary mb-2">{{ __('translations.upload') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ __('translations.close') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
            <div class="row">
                <!-- Gallery item -->
                @foreach($documents as $document)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="bg-white rounded shadow-sm">
                            <div class="text-center pt-2 display-4">
                                <a href="{{ asset($document->file) }}">
                                    <i class=" text-danger fa fa-file-pdf-o"></i>
                                </a>
                            </div>
                            <div class="text-dark p-2">
                                @php
                                    $string = strip_tags($document->title);
                                    if (strlen($string) > 30) {
                                        $stringCut = substr($string, 0, 30);
                                        $endPoint  = strrpos($stringCut, ' ');
                                        $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string   .= "...";
                                    }
                                    echo strlen($string) ? $string : '--';
                                @endphp
                            </div>
                            <div class="p-4">
                                <div
                                    class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                    <a href="{{ route('document.details',[$locale,$document->id]) }}">
                                        <i class="text-success cil-image1" title="Details"></i>
                                    </a>
                                    @if($user->role < 2)
                                        <a href="{{ route('document.edit',[$locale,$document->id]) }}">
                                            <i class="text-info cil-pencil" title="Edit"></i>
                                        </a>
                                        <a href="{{ route('document.delete',[$locale,$document->id]) }}"
                                           onclick="return confirm('Delete this file?')">
                                            <i class="text-danger cil-trash" title="Delete"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- End -->
            </div>
            <div class="py-5 text-right"> {{ $documents->onEachSide(5)->links() }}</div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('my_ckeditor');
        });

        $('#file').bind('change', function () {
            console.log(this.files[0].size)
            if (this.files[0].size > 4096000000) {
                alert('This file size is too large: ' + this.files[0].size / 4096 / 4096 + "MiB");
            }
        });
    </script>
@endsection
