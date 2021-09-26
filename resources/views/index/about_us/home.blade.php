@extends('index.layout')
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="row" @if($locale === 'fas')dir="rtl"@endif>
                <h3>
                    <div class="pb-3">
                        {{ $homepage->about_us_title }}
                    </div>
                </h3>
            </div>
            <div class="row" @if($locale === 'fas')dir="rtl"@endif>
                <h3>
                    <small class="text-muted text-justify">
                        @php
                            echo $homepage->about_us_des;
                        @endphp
                    </small>
                </h3>
            </div>
        </main>
    </div>
@endsection
