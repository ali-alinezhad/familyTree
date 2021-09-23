@extends('index.layout')
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="row">
                @foreach($news as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 pb-4" style="min-height: 300px">
                        <div class="bg-white rounded shadow-sm">
                            <a href="{{ route('index.news.details',[$locale,$item->id]) }}">
                                <div class="p-4 content-center">
                                    <img class="img-fluid card-img-top"
                                         src="{{ asset($item->pic) }}"
                                         alt="Generic placeholder image"
                                         style="height: 200px !important;">
                                </div>
                                <div class="text-dark p-2">
                                    @php
                                        $string = strip_tags($item->title);
                                        if (strlen($string) > 30) {
                                            $stringCut = substr($string, 0, 30);
                                            $endPoint  = strrpos($stringCut, ' ');
                                            $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string   .= "...";
                                        }
                                        echo $string;
                                    @endphp
                                </div>
                                <div
                                    class="text-black-50 p-2 d-flex align-items-center justify-content-between bg-light px-3 py-2 mt-4">
                                    @php
                                        $string = strip_tags($item->description);
                                        if (strlen($string) > 40) {
                                            $stringCut = substr($string, 0, 40);
                                            $endPoint  = strrpos($stringCut, ' ');
                                            $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string   .= "...";
                                        }
                                        echo $string;
                                    @endphp
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="py-5 text-right"> {{ $news->onEachSide(5)->links() }}</div>
        </main>
    </div>
@endsection
