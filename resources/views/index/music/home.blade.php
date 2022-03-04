@extends('index.layout')
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="row">
                @foreach($musics as $music)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('index.music.details',[$locale,$music->id]) }}">
                            <div class="bg-white rounded shadow-sm">
                                <audio class="text-center" src="{{ asset($music->file) }}"
                                       style="height: 30px; width: 170px;"
                                       controls>
                                </audio>
                                <div
                                    class="text-dark d-flex bg-light px-3 py-2 align-items-center justify-content-between mb-4 mt-4">
                                    @php
                                        $string = strip_tags($music->title);
                                        $string = strlen($string) ? $string : '---';
                                        if (strlen($string) > 30) {
                                            $stringCut = substr($string, 0, 30);
                                            $endPoint  = strrpos($stringCut, ' ');
                                            $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string   .= "...";
                                        }
                                        echo $string;
                                    @endphp
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="py-5 text-right"> {{ $musics->onEachSide(5)->links() }}</div>
        </main>
    </div>
@endsection
