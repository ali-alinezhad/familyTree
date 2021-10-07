@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 pl-5">
            <img src="{{ asset($news->pic) }}" width="100%" height="400"/>
        </div>
        <div class="col-md-6 pl-5">
            <div>
                <h3>{{ $news->title }}</h3>
                <div class="text-info">{{ $news->created_at }}</div>
            </div>
            <hr>
            <div>@php echo $news['description'] ?? '--' ; @endphp</div>
        </div>
    </div>
@endsection
