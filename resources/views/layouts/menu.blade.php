@php $locale = session()->get('locale'); @endphp
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home',['lang'=> $locale]) }}">
        <i class="c-sidebar-nav-icon cil-home"></i>{{ __('translations.home') }}
    </a>
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
