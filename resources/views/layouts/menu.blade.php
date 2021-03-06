@php
    $locale = session()->get('locale') ?? 'fas';
    $username = session()->get('user');
    $user = \App\User::where('username',$username)->first();
@endphp
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-home"></i>{{ __('translations.home') }}
    </a>
</li>

<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-user"></i>{{ __('translations.users') }}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users',['lang'=> $locale]) }}">
                <i class="c-sidebar-nav-icon cil-puzzle"></i>{{ __('translations.user_list') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('message.inbox',['lang'=> $locale]) }}">
                <i class="c-sidebar-nav-icon cil-puzzle"></i> {{ __('translations.inbox') }}
            </a>
        </li>
        @if($user && $user->role < 2)
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('register') }}">
                    <i class="c-sidebar-nav-icon cil-puzzle"></i>{{ __('translations.register') }}
                </a>
            </li>
        @endif
    </ul>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('gallery',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-image1"></i>{{ __('translations.gallery') }}
    </a>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('document',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-notes"></i>{{ __('translations.document') }}
    </a>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('music',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-music-note"></i>{{ __('translations.music') }}
    </a>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('news',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-newspaper"></i>{{ __('translations.news') }}
    </a>
</li>
@if($user && $user->role < 2)
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('homepage.edit',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-screen-desktop"></i>{{ __('translations.homepage') }}
    </a>
</li>
@endif
@if($user && $user->role < 1)
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('clear.cache',['lang'=> $locale]) }}">
            <i class="c-sidebar-nav-icon cil-puzzle"></i>{{ __('translations.cache') }}
        </a>
    </li>
@endif
