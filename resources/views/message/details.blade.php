@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row"> {{ $message['subject'] }} </div>
        <div class="row"> {{ $message['description'] }} </div>
    </div>
@endsection
