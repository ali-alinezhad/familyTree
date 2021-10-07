@extends('index.layout')
@section('content')
    <div class="row p-5 bg-white">
        <div class="col-md-6 pl-5">
            <img src="{{ asset($picture->pic) }}" width="100%" height="400"/>
        </div>
        <div class="col-md-6 pl-5">
            <div>
                <h3 dir="rtl">{{ $picture->title }}</h3>
                <div class="text-info">{{ $picture->created_at }}</div>
            </div>
            <hr>
            <div dir="rtl">@php echo $picture['description'] ?? '--' ; @endphp</div>
        </div>
    </div>
@endsection
