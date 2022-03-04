@extends('index.layout')
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="row">
                @foreach($documents as $document)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('index.document.details',[$locale,$document->id]) }}">
                            <div class="bg-white rounded shadow-sm">
                                @if(strpos($document->file,'.pdf') !== false)
                                    <embed src="{{ asset($document->file) }}" width="100%" height="400">
                                @else
                                    <div class="text-center pt-2 display-4">
                                        <a href="{{ asset($document->file) }}">
                                            <i class=" text-danger fa fa-file-pdf-o"></i>
                                        </a>
                                    </div>
                                @endif
                                <div
                                    class="text-dark d-flex bg-light px-3 py-2 align-items-center justify-content-between mb-4 mt-4">
                                    @php
                                        $string = strip_tags($document->title);
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
            <div class="py-5 text-right"> {{ $documents->onEachSide(5)->links() }}</div>
        </main>
    </div>
@endsection
