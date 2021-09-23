@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="px-lg-5">
            @if($user->role < 2)
                <div class="row pb-5">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#insertNews">
                        Insert News <i class="cil-plus"></i>
                    </button>
                </div>
                <div id="insertNews" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                Image
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                {{ Form::open(['route'=>['news.create',$locale], 'method' => 'put','enctype'=>"multipart/form-data"]) }}
                                <div>
                                    <div class="form-group">
                                        <label for="subject">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" required>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="ckeditor form-control" name="description"
                                                  id="my_ckeditor" required></textarea>
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
            @endif
            <div class="row">
                @foreach($news as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 pb-4" style="min-height: 300px">
                        <div class="bg-white rounded shadow-sm">
                            <div class="p-4 content-center">
                                <img class="img-fluid card-img-top"
                                     src="{{ asset($item->pic) }}"
                                     alt="Generic placeholder image"
                                     style="height: 200px !important;">
                            </div>
                            <div class="text-dark p-3">
                                @php
                                    $string = strip_tags($item->title);
                                    if (strlen($string) > 30) {
                                        $stringCut = substr($string, 0, 30);
                                        $endPoint  = strrpos($stringCut, ' ');
                                        $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string   .= "...";
                                    }
                                    echo $string;
                                @endphp
                            </div>
                            <div class="text-black-50 p-3">
                                @php
                                    $string = strip_tags($item->description);
                                    if (strlen($string) > 40) {
                                        $stringCut = substr($string, 0, 40);
                                        $endPoint  = strrpos($stringCut, ' ');
                                        $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string   .= "...";
                                    }
                                    echo $string;
                                @endphp
                            </div>
                            <div>
                                <div
                                    class="d-flex align-items-center justify-content-between bg-light px-3 py-2 mt-4">
                                    <a href="{{ route('news.details',[$locale,$item->id]) }}">
                                        <i class="text-success cil-image1" title="Details"></i>
                                    </a>
                                    @if($user->role < 2)
                                        <a href="{{ route('news.edit',[$locale,$item->id]) }}">
                                            <i class="text-info cil-pencil" title="Edit"></i>
                                        </a>
                                        <a href="{{ route('news.delete',[$locale,$item->id]) }}"
                                           onclick="return confirm('Delete this News?')">
                                            <i class="text-danger cil-trash" title="Delete"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="py-5 text-right"> {{ $news->onEachSide(5)->links() }}</div>
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

        $('#picture').bind('change', function () {
            console.log(this.files[0].size)
            if (this.files[0].size > 4096000000) {
                alert('This file size is too large: ' + this.files[0].size / 4096 / 4096 + "MiB");
            }
        });
    </script>
@endsection
