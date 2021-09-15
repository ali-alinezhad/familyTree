<!DOCTYPE html>
<html lang="">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ asset('css/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<style>
    audio {
        width: 150px;
        display: block;
        margin: 20px;
    }

    audio:nth-child(2) {
        width: 250px;
    }

    audio:nth-child(3) {
        width: 350px;
    }

</style>
<!-- Top Background Image Wrapper -->
<div class="bgded" style="background-image:url({{ asset($homepage->logo) }});">
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
            </div>
            <nav id="mainav" class="fl_right">
                <ul class="clear">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="#introblocks">Gallery</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#about_us">About us</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </nav>
            <audio class="text-center" src="{{ $homepage->music }}" controls style=" width: 200px;"></audio>
        </header>
    </div>

    <div class="overlay">
        <div id="pageintro" class="hoc clear">
            <article>
                <h3 class="heading"> {{ $homepage->header_title }}</h3>
                <p> @php echo $homepage->header_des @endphp</p>
            </article>
        </div>
    </div>
</div>
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
            <div class="one_half first">
                <img class="inspace-15 borderedbox" src="{{ asset('images/logo/logo.jpg') }}" alt="">
            </div>
            <div class="one_half">
                <ul class="nospace group inspace-15">
                    </li>
                    @foreach($newses as $key => $news)
                        <li class="one_half @if(!($key % 2)) first @endif @if($key < 2) btmspace-50 @endif">
                            <article>
                                <h6 class="heading"><a href="#">
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
        <p class="heading underline font-x2">{{ $homepage->about_us_title }}</p>
        <p class="nospace font-xs">@php echo $homepage->about_us_des @endphp</p>
    </figure>
</div>
<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2021- All Rights Reserved</p>
        <p class="fl_right">Developed by
            <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">
                Ali Alinezhad
            </a>
        </p>
    </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="{{ asset("js/scripts/jquery.min.js") }}"></script>
<script src="{{ asset("js/scripts/jquery.backtotop.js") }}"></script>
<script src="{{ asset("js/scripts/jquery.mobilemenu.js") }}"></script>
</body>
</html>
