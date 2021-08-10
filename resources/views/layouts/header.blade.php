@php
$username = session()->get('user');
$user     = \App\User::where('username',$username)->first();
if($user){
    $profile = \App\Model\Profile::where('user_id',$user->id)->first();
}
@endphp
<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>
<a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
    <img src="https://infyom.com/images/logo/logo_236w.png" width="118" alt="Brand Logo">
</a>
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>
<ul class="c-header-nav mfs-auto">
</ul>
<ul class="c-header-nav">
    <li>
        <nav class="navbar navbar-expand navbar-dark">
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    @php $locale = session()->get('locale') ?? 'fas'; @endphp
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('en')
                                <div class="c-avatar">
                                    <img class="c-avatar-img" src="{{asset('images/cif-us.svg')}}"> English
                                </div>
                                @break
                                @case('fas')
                                <div class="c-avatar">
                                    <img class="c-avatar-img" src="{{asset('images/cif-ir.svg')}}"> Farsi
                                </div>
                                @break
                                @default
                                <div class="c-avatar">
                                    <img class="c-avatar-img" src="{{asset('images/cif-us.svg')}}"> English
                                </div>
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/en">
                                <div class="c-avatar">
                                    <img class="c-avatar-img" src="{{asset('images/cif-us.svg')}}"> English
                                </div>
                            </a>
                            <a class="dropdown-item" href="/fas">
                                <div class="c-avatar">
                                    <img class="c-avatar-img" src="{{asset('images/cif-ir.svg')}}"> Farsi
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </li>
    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar">
                <img class="c-avatar-img" src="
                    @if(isset($profile) && $profile['picture'])
                        {{asset($profile->picture)}}
                    @else
                        {{ asset('images/unknown.png') }}
                    @endif
                 " alt="User">
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
            <a class="dropdown-item" href="{{ route('users.profile',['lang' => $locale,'username'=> $username]) }}">
                <i class="c-icon mfe-2 cil-user"></i>{{ __('translations.profile') }} ({{  $username }})
            </a>
            <a class="dropdown-item" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="c-icon mfe-2 cil-account-logout"></i>{{ __('translations.logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
<div class="c-subheader justify-content-between px-3">
    @yield('breadcrumb')
</div>
