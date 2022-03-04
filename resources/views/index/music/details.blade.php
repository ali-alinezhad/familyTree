@extends('index.layout')
@section('content')
    <div class="row p-5 bg-white">
        <div class="col-md-6 pl-5">
            <audio class="text-center" src="{{ asset($music->file) }}" style="height: 30px; width: 170px;"
                   controls>
            </audio>
        </div>
        <div class="col-md-6 pl-5">
            <div>
                <h3 dir="rtl">{{ $music->title }}</h3>
                <div class="text-info">{{ $music->created_at }}</div>
            </div>
            <hr>
            <div dir="rtl">@php echo $music['description'] ?? '--' ; @endphp</div>
        </div>
    </div>
@endsection
