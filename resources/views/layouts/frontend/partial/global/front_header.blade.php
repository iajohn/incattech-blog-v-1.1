<header>
    <div class="main-menu" id="main-menu">
        <div class="container">                
            <div class="row align-items-center justify-content-between menu-bar">
                <div>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/frontend/themes/img/incattech/logo.png') }}" alt="">
                    </a>
                </div>

                <div class="logo col-md-2">
                    <a class="" href="{{ route('home') }}">
                        <img src="{{ asset('assets/frontend/themes/img/incattech/logo.png') }}" alt="">
                    </a>
                </div>

                <nav id="nav-menu-container" class="ml-auto">
                    <ul class="nav-menu">
                        <li class="menu-has-children {{ Request::is('category*') ? 'menu-active' : '' }}">
                            <a href="">{{ __('Topics')}}</a>
                            <ul>
                                @foreach($categories as $cat)
                                    <li class="">
                                        <a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}">
                                            {{ $cat->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="{{ Request::is('/') ? 'menu-active' : '' }}">
                           <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        </li>

                        <li class="{{ Request::is('posts*') ? 'menu-active' : '' }}">
                            <a href="{{ route('post.index') }}"><i class="fa fa-edit"></i> Posts</a>
                        </li>

                        <li class="{{ Request::is('tv*') ? 'menu-active' : '' }}">
                            <a href="{{ route('tv') }}"><i class="fa fa-play"></i> Tv</a>
                        </li>

                        <li class="menu-has-children"><a href="">More</a>
                            <ul>
                                @guest
                                    <li><a href="{{ route('all_author') }}">All Authors</a></li>
                                @else
                                    @if(Auth::user()->role->id == 1)
                                        <li>
                                            <a href="{{ route('author.profile', Auth::user()->username) }}"> 
                                               <i class="fa fa-user"></i> {{ Auth::user()->username }} 
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user()->role->id == 2)
                                        <li>
                                            <a href="{{ route('author.profile', Auth::user()->username) }}"> 
                                               <i class="fa fa-user"></i> {{ Auth::user()->username }} 
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user()->role->id == 3)
                                        <li>
                                            <a href="{{ route('user.account.user') }}"> 
                                               <i class="fa fa-user"></i> {{ Auth::user()->username }} 
                                            </a>
                                        </li>
                                    @endif
                                @endguest
                                <!-- <li><a href="{{ route('tv') }}">TV</a></li> -->
                                <li><a href="{{ route('contact') }}"><i class="fa fa-map-o"></i> Contact</a></li>
                                <li><a href="{{ route('about') }}"><i class="fa fa-info"></i> About</a></li>
                                @guest
                                    <li><a href="{{ route('login') }}"><i class="fa fa-singin"></i> Login</a></li>
                                @else
                                    @if(Auth::user()->role->id == 1)
                                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    @endif
                                    @if(Auth::user()->role->id == 2)
                                        <li><a href="{{ route('author.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    @endif
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <div class="mobile-toggle">
                    <a href="#" data-toggle="sidebar" data-target="#sidebar" class="btn btn-xs primary-btn">
                        <i class="lnr lnr-chevron-left"></i>
                    </a>
                </div>

                <div class="navbar-right ml-auto">
                    <form method="GET" action="{{ route('search') }}" class="Search">
                        <input type="text" class="form-control Search-box" value="{{ isset($query) ? $query : '' }}" 
                               name="query" id="Search-box" placeholder="Search">
                        <label for="Search-box" class="Search-box-label">
                            <span class="lnr lnr-magnifier"></span>
                        </label>
                        <span class="Search-close">
                            <span class="lnr lnr-cross"></span>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>