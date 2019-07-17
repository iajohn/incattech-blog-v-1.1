<header id="header" class="header-area">
    <!-- Top -->
    <section id="top" class="topBar show-for-large">
        <div class="row">
            <div class="medium-6 columns">
                <div class="top-button">
                    <aside>
                        <div class="aside-body">
                            <figure class="ads">
                                <div class="ad-widget-wrap">
                                    <img src="{{ asset('assets/frontend/themes/img/ads/ad-750x80.png') }}" style="width:100%;" alt="">
                                </div>
                                <figcaption>Advertisement</figcaption>
                            </figure>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="top-button">
                    <aside>
                        <div class="aside-body">
                            <figure class="ads">
                                <!-- <ul class="menu float-right">
                                    <li class="{{ Request::is('tv*') ? 'active' : '' }}">
                                        <a href="{{ route('tv') }}">TV</a>
                                    </li>
                                    @guest
                                        <li class="{{ Request::is('author*') ? 'active' : '' }}">
                                            <a href="{{ route('all_author') }}">All Authors</a>
                                        </li>
                                    @else
                                        @if(Auth::user()->role->id == 1)
                                            <li class="{{ Request::is('author*') ? 'active' : '' }}">
                                                <a href="{{ route('author.profile', Auth::user()->username) }}"> {{ Auth::user()->username }} </a>
                                            </li>
                                        @endif
                                        @if(Auth::user()->role->id == 2)
                                            <li class="{{ Request::is('author*') ? 'active' : '' }}">
                                                <a href="{{ route('author.profile', Auth::user()->username) }}"> {{ Auth::user()->username }} </a>
                                            </li>
                                        @endif
                                        @if(Auth::user()->role->id == 3)
                                            <li class="{{ Request::is('profile*') ? 'active' : '' }}">
                                                <a href="{{ route('user.account.user') }}"> {{ Auth::user()->username }} </a>
                                            </li>
                                        @endif
                                    @endguest
                                    
                                    <li class="{{ Request::is('contact*') ? 'active' : '' }}">
                                        <a href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    <li class="{{ Request::is('about*') ? 'active' : '' }}">
                                        <a href="{{ route('about') }}">About</a>
                                    </li>
                                    @guest
                                        <li class="{{ Request::is('login') ? 'active' : '' }}">
                                            <a href="{{ route('login') }}">Login</a>
                                        </li>
                                    @else
                                        @if(Auth::user()->role->id == 1)
                                            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                        @endif
                                        @if(Auth::user()->role->id == 2)
                                            <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                                                <a href="{{ route('author.dashboard') }}">Dashboard</a>
                                            </li>
                                        @endif
                                    @endguest
                                </ul> -->
                                @foreach($company as $setting)
                                    <ul class="menu float-right" style="margin-top:5px;">
                                        <li class="social">
                                            <a href="{{ $setting->facebook }}"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="social">
                                            <a href="{{ $setting->instagram }}"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="social">
                                            <a href="{{ $setting->twitter }}"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="social">
                                            <a href="{{ $setting->youtube }}"><i class="fa fa-youtube"></i></a>
                                        </li>
                                        <li class="social">
                                            <a href="{{ $setting->whatsapp }}"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                        <!-- <li class="social"><a href=""><i class="fa fa-whatsapp"></i></a></li> -->
                                        <!-- <li><a href=""><i class="fa fa-facebook"></i></a></li> -->
                                    </ul>
                                @endforeach
                            </figure>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section><!-- End Top -->
    <!--Navber-->
    <section id="navBar" class="main-menu">
        <nav class="sticky-container" data-sticky-container>
            <div class="sticky topnav" data-sticky data-top-anchor="navBar" data-btm-anchor="footer-bottom:bottom" data-margin-top="0" data-margin-bottom="0" style="width: 100%; background: #fff;" data-sticky-on="large">
                <div class="row">
                    <div class="large-12 columns">
                        <div class="title-bar" data-responsive-toggle="beNav" data-hide-for="large">
                            <button class="menu-icon" type="button" data-toggle="offCanvas-responsive"></button>
                            <div class="title-bar-title">
                                <a href="{{ route('tv') }}" class="logo">
                                    <span class="l">@if ($company) @foreach ($company as $setting) {{ $setting->name }} @endforeach @endif</span><em><span class="l">T</span>v</em>
                                </a>
                            </div>
                        </div>

                        <div class="top-bar show-for-large" id="beNav" style="width: 100%;">
                            <div class="top-bar-left">
                                <ul class="menu">
                                    <li class="menu-text">
                                        <a href="{{ route('tv') }}" class="logo">
                                            <span class="l c-n">@if ($company) @foreach ($company as $setting) {{ $setting->name }} @endforeach @endif</span><em><span class="l">T</span>v</em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-bar-right search-btn">
                                <ul class="menu">
                                    <li class="search">
                                        <i class="fa fa-search"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-bar-right">
                                <ul class="menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown">
                                    <li>
                                        <a href="{{ route('tv') }}"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <!-- <li><a href="{{ route('tv') }}"><i class="fa fa-home"></i>Tv</a></li> -->
                                    <li>
                                        <a href="#"><i class="fa fa-th"></i>Channel</a>
                                        {!! getFrontEndCategories() !!}
                                    </li>
                                    <!-- @if(Auth::check())
                                    <li>
                                        <a href="#"><i class="fa fa-magic"></i>Account</a>
                                        <ul class="submenu menu vertical" data-submenu data-animate="slide-in-down slide-out-up">
                                            <li><a href="{{ route('user.account.user') }}">
                                                    <i class="fa fa-magic"></i>My Account</a>
                                            </li>
                                            <li><a href="{{ route('user.account.edit') }}"><i class="fa fa-magic"></i>My Account Setting</a></li>
                                        </ul>
                                    </li>
                                    @endif -->
                                    <li>
                                        <a href="{{ route('post.index') }}"><i class="fa fa-edit"></i>Posts</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-magic"></i>More</a>
                                        <ul class="submenu menu vertical" data-submenu data-animate="slide-in-down slide-out-up">
                                            @guest
                                                <li>
                                                    <a href="{{ route('all_author') }}">
                                                        <i class="fa fa-users"></i>All Authors
                                                    </a>
                                                </li>
                                            @else
                                                @if(Auth::user()->role->id == 1)
                                                    <li>
                                                        <a href="{{ route('author.profile', Auth::user()->username) }}"> 
                                                            <i class="fa fa-user"></i>{{ Auth::user()->username }} 
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(Auth::user()->role->id == 2)
                                                    <li>
                                                        <a href="{{ route('author.profile', Auth::user()->username) }}"> 
                                                            <i class="fa fa-user"></i>{{ Auth::user()->username }} 
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(Auth::user()->role->id == 3)
                                                    <li>
                                                        <a href="{{ route('user.account.user') }}">
                                                            <i class="fa fa-user"></i>{{ Auth::user()->username }} 
                                                        </a>
                                                    </li>
                                                @endif
                                            @endguest
                                            <li><a href="{{ route('home') }}"><i class="fa fa-edit"></i> Blog</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                            <li><a href="{{ route('about') }}">About</a></li>
                                            @guest
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                            @else
                                                @if(Auth::user()->role->id == 1)
                                                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                                @endif
                                                @if(Auth::user()->role->id == 2)
                                                    <li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
                                                @endif
                                            @endguest
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="search-bar" class="clearfix search-bar-light">
                    <form method="get" action="{{ url("/tv/search/all") }}">
                        <div class="search-input float-left">
                            <input type="search" name="search" placeholder="Seach Here your video">
                        </div>
                        <div class="search-btn float-right text-right">
                            <button class="button" type="submit">search now</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </section>
</header><!-- End Header -->