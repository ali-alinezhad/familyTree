@extends('index.layout')
@section('content')
<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- Gallery -->
        <section id="introblocks">
            <ul class="nospace group btmspace-80">
                @if(!empty($pictures) &&  !stristr($_SERVER['HTTP_USER_AGENT'],'mobi'))
                    @foreach($pictures as $key => $picture)
                        <li class="one_third @if(!$key) first @endif">
                            <figure><a class="imgover"><img src="{{ $picture->pic }}"
                                                            alt="{{ asset('images/logo/logo.jpg') }}"
                                                            style="width:350px ;height: 170px;!important;"></a>
                                <figcaption>
                                    <h6 class="heading">{{ $picture->title ?? '--' }}</h6>
                                    <div>
                                        <p></p>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                @else
                    <li class="one_third first">
                        <figure><img src="{{ asset('images/logo/logo.jpg') }}">
                            <figcaption>
                                <h6 class="heading"></h6>
                                <div>
                                    <p></p>
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                @endif
            </ul>
        </section>
        <hr class="btmspace-80">
        <!-- News -->
        <section class="group" id="news">
            <div class="one_half first pt-5">
                <img class="inspace-15 borderedbox" src="{{ asset($homepage->logo) }}" alt="{{ asset('images/logo/logo.jpg') }}">
            </div>
            <div class="one_half">
                <ul class="nospace group inspace-15">
                    </li>
                    @foreach($newses as $key => $news)
                        <li class="one_half @if(!($key % 2)) first @endif @if($key < 2) btmspace-50 @endif">
                            <article>
                                <h6 class="heading"><a href="{{ route('index.news.details',[$locale,$news->id]) }}">
                                        @php
                                            $string = strip_tags($news->title);
                                            if (strlen($string) > 30) {
                                                $stringCut = substr($string, 0, 30);
                                                $endPoint  = strrpos($stringCut, ' ');
                                                $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $string   .= "...";
                                            }
                                            echo $string;
                                        @endphp
                                    </a></h6>
                                <p class="nospace">
                                    @php
                                        $string = strip_tags($news->description);
                                        if (strlen($string) > 40) {
                                            $stringCut = substr($string, 0, 40);
                                            $endPoint  = strrpos($stringCut, ' ');
                                            $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string   .= "...";
                                        }
                                        echo $string;
                                    @endphp
                                </p>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="clear"></div>
    </main>
</div>
<div class="bgded overlay" id="about_us">
    <figure class="hoc container clear imgroup">
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
    </figure>
</div>
@endsection
