@php $locale = session()->get('locale') ?? 'fas'; @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <header>
        <div>

        </div>
    </header>
        <div>
        <img src="{{asset('images/logo/logo.jpg')}}" height="300" width="1200">
    </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">{{ __('translations.login') }}</a>
                    @endauth

                    <ul class="c-header-nav">
                        <li>
                            <nav class="navbar navbar-expand navbar-dark">
                        <div class="collapse navbar-collapse" id="navbarToggler">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @switch($locale)
                                            @case('en')
                                            <div class="c-avatar">
                                               English
                                            </div>
                                            @break
                                            @case('fas')
                                            <div class="c-avatar">
                                                Farsi
                                            </div>
                                            @break
                                            @default
                                            <div class="c-avatar">
                                                English
                                            </div>
                                        @endswitch
                                        <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/en">
                                            <div class="c-avatar">
                                                 English
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="/fas">
                                            <div class="c-avatar">
                                                 Farsi
                                            </div>
                                        </a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                        </li>
                    </ul>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel22
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
