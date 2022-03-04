@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 pl-5">
            <div class="text-center pt-3">
                <audio class="text-center" src="{{ asset($music->file) }}" style="height: 30px; width: 170px;"
                       controls>
                </audio>
            </div>
        </div>
        <div class="col-md-6 pl-5">
            <div>
                <h3>{{ $music->title }}</h3>
                <div class="text-info">{{ $music->created_at }}</div>
            </div>
            <hr>
            <div>@php echo $music['description'] ?? '--' ; @endphp</div>
        </div>
    </div>
@endsection
