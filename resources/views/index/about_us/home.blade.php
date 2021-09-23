@extends('index.layout')
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="row">
                <h3>
                    <div class="pb-4" dir="rtl">
                        {{ $homepage->about_us_title }}
                    </div>
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
