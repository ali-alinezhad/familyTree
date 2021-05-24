@php
    $locale = session()->get('locale') ?? 'en';
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
            <a class="c-sidebar-nav-link" href="#">
                <i class="c-sidebar-nav-icon cil-puzzle"></i> Nav dropdown item
            </a>
        </li>
    </ul>
</li>



<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('gallery',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-image1"></i>{{ __('translations.gallery') }}
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('news',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-newspaper"></i>{{ __('translations.news') }}
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('tree',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-list"></i>{{ __('translations.tree') }}
    </a>
</li>
