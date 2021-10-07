@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 pl-5">
            <img src="{{ asset($image->pic) }}" width="100%" height="400"/>
        </div>
        <div class="col-md-6 pl-5">
            <div>
                <h3>{{ $image->title }}</h3>
                <div class="text-info">{{ $image->created_at }}</div>
            </div>
            <hr>
            <div>@php echo $image['description'] ?? '--' ; @endphp</div>
        </div>
    </div>
@endsection
