<!DOCTYPE html>
<html lang="">
<head>
    <title>{{ __('translations.doodman') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ asset('css/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
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
<div class="bgded" style="background-image:url({{ asset($homepage->logo) }});">
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
            </div>
            <nav id="mainav" class="fl_right">
                <ul class="clear">
                    <li>
                        <a class="drop" href="#">
                            @switch(session()->get('locale'))
                                @case('en')
                                    <img class="c-avatar" src="{{asset('images/cif-us.svg')}}">
                                @break
                                @case('fas')
                                    <img class="c-avatar" src="{{asset('images/cif-ir.svg')}}">
                                @break
                                @default
                                    <img class="c-avatar" src="{{asset('images/cif-ir.svg')}}">
                            @endswitch
                        </a>
                        <ul>
                            <li><a href="/en"> <img class="c-avatar" src="{{asset('images/cif-us.svg')}}"></a></li>
                            <li><a href="/fas"> <img class="c-avatar" src="{{asset('images/cif-ir.svg')}}"></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('index.login',['lang' => $locale]) }}">{{ __('translations.login') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('index.about_us',['lang' => $locale]) }}">{{ __('translations.about_us') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('index.gallery.show',['lang' => $locale]) }}">{{ __('translations.gallery') }}</a>
                    </li>
                    <li><a href="{{ route('index.news.show',['lang' => $locale]) }}">{{ __('translations.news') }}</a>
                    </li>
                    <li class="active">
                        <a href="/">{{ __('translations.homepage') }}</a>
                    </li>
                </ul>
            </nav>
            <audio class="text-center" src="{{ asset($homepage->music) }}" style="height: 30px; width: 170px;"
                   controls loop autoplay>
            </audio>
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
@yield('content')
<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2021- All Rights Reserved</p>
{{--        <p class="fl_right">Developed by--}}
{{--            <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">--}}
{{--                Ali Alinezhad--}}
{{--            </a>--}}
{{--        </p>--}}
    </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="{{ asset("js/scripts/jquery.min.js") }}"></script>
<script src="{{ asset("js/scripts/jquery.backtotop.js") }}"></script>
<script src="{{ asset("js/scripts/jquery.mobilemenu.js") }}"></script>
</body>
</html>
