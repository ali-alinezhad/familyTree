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
    audio { width: 150px; display: block; margin:20px; }
    audio:nth-child(2) { width: 250px; }
    audio:nth-child(3) { width: 350px; }

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
                <li class="one_third first">
                    <figure><a class="imgover" href="#"><img src="{{ asset('images/logo/logo.jpg') }}" alt=""></a>
                        <figcaption>
                            <h6 class="heading">Mollis suscipit</h6>
                            <div>
                                <p>Eu adipiscing sit amet ante donec vulputate magna duis posuere tellus vel fringilla
                                    auctor nisi arcu.</p>
                            </div>
                        </figcaption>
                    </figure>
                </li>
                <li class="one_third">
                    <figure><a class="imgover" href="#"><img src="{{ asset('images/logo/logo.jpg') }}" alt=""></a>
                        <figcaption>
                            <h6 class="heading">Vestibulum maecenas</h6>
                            <div>
                                <p>Urna at congue lectus nisi ac neque suspendisse vitae sapien eu mi placerat tincidunt
                                    sed eget elit in.</p>
                            </div>
                        </figcaption>
                    </figure>
                </li>
                <li class="one_third">
                    <figure><a class="imgover" href="#"><img src="{{ $homepage->logo }}"
                                                             alt="{{ asset('images/logo/logo.jpg') }}"></a>
                        <figcaption>
                            <h6 class="heading">Pellentesque enim</h6>
                            <div>
                                <p>Imperdiet pede sit amet elit aenean sollicitudin eros quis cursus feugiat lacus diam
                                    tempor tortor vel.</p>
                            </div>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </section>
        <hr class="btmspace-80">
        <!-- News -->
        <section class="group" id="news">
            <div class="one_half first"><img class="inspace-15 borderedbox" src="{{ asset('images/logo/logo.jpg') }}"
                                             alt=""></div>
            <div class="one_half">
                <ul class="nospace group inspace-15">
                    <li class="one_half first btmspace-50">
                        <article>
                            <h6 class="heading"><a href="#">Posuere ultricies</a></h6>
                            <p class="nospace">Sed tellus fusce velit orci aliquet et condimentum sit amet dapibus eget
                                odio vivamus urna pellentesque felis&hellip;</p>
                        </article>
                    </li>
                    <li class="one_half btmspace-50">
                        <article>
                            <h6 class="heading"><a href="#">Pellentesque ipsum</a></h6>
                            <p class="nospace">Ut quam imperdiet tincidunt vestibulum eget magna eget sem imperdiet
                                tincidunt praesent sit amet adipiscing&hellip;</p>
                        </article>
                    </li>
                    <li class="one_half first">
                        <article>
                            <h6 class="heading"><a href="#">Risus auctor vel</a></h6>
                            <p class="nospace">Accumsan curabitur cursus porta lectus nam posuere orci in elementum
                                molestie purus erat volutpat ullamcorper&hellip;</p>
                        </article>
                    </li>
                    <li class="one_half">
                        <article>
                            <h6 class="heading"><a href="#">Volutpat vitae</a></h6>
                            <p class="nospace">Elit purus non odio etiam dictum euismod lectus vestibulum tincidunt erat
                                vel molestie gravida ligula lacus&hellip;</p>
                        </article>
                    </li>
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
