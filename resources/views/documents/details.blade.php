@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if(strpos($document->file,'.pdf') !== false)
                    <embed src="{{ asset($document->file) }}" width="100%" height="400">
                @else
                    <div class="text-center pt-2 display-4">
                        <a href="{{ asset($document->file) }}">
                            <i class=" text-danger fa fa-file-pdf-o"></i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-6 pl-5">
                <div>
                    <h3>{{ $document->title }}</h3>
                    <div class="text-info">{{ $document->created_at }}</div>
                </div>
                <hr>
                <div>@php echo $document['description'] ?? '--' ; @endphp</div>
            </div>
        </div>
    </div>
@endsection
