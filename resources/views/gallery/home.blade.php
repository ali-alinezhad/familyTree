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
            <div class="row pb-5">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#uploadImage">
                    Upload new image <i class="cil-plus"></i>
                </button>
            </div>

            <div id="uploadImage" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            Image
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(['route'=>['gallery.upload',$locale], 'method' => 'put','enctype'=>"multipart/form-data"]) }}
                            <div>
                                <div class="form-group">
                                    <label for="subject">Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="ckeditor form-control" name="description"
                                              id="my_ckeditor"></textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="picture"></label>
                                    <input type="file" name="picture" onchange="readURL(this);" id="picture"
                                           accept=".gif,.jpg,.jpeg,.png">

                                    @error('picture')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="" id="image">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="checkbox" name="status" id="status">
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mb-2">Upload</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- Gallery item -->
                @foreach($images as $image)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="bg-white rounded shadow-sm">
                            <img src="{{ asset($image->pic) }}" alt="{{ asset('images/unknown.png') }}" class="img-fluid card-img-top"
                                 title="{{ $image->title ?? "--" }}"
                                 style="height: 200px !important;">
                            <div class="text-dark p-2">
                                @php
                                    $string = strip_tags($image->title);
                                    if (strlen($string) > 30) {
                                        $stringCut = substr($string, 0, 30);
                                        $endPoint  = strrpos($stringCut, ' ');
                                        $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string   .= "...";
                                    }
                                    echo $string;
                                @endphp
                            </div>
                            <div class="p-4">
                                <div
                                    class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                    <a href="{{ route('gallery.details',[$locale,$image->id]) }}">
                                        <i class="text-success cil-image1" title="Details"></i>
                                    </a>
                                    @if($user->role < 2)
                                        <a href="{{ route('gallery.edit',[$locale,$image->id]) }}">
                                            <i class="text-info cil-pencil" title="Edit"></i>
                                        </a>
                                        <a href="{{ route('gallery.delete',[$locale,$image->id]) }}"
                                           onclick="return confirm('Delete this image?')">
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
            <div class="py-5 text-right"> {{ $images->onEachSide(5)->links() }}</div>
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
                    $('#image')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

            $('#picture').bind('change', function() {
                console.log(this.files[0].size)
                if (this.files[0].size  > 4096000000) {
                    alert('This file size is too large: ' + this.files[0].size / 4096 / 4096 + "MiB");
                }
        });
    </script>
@endsection
