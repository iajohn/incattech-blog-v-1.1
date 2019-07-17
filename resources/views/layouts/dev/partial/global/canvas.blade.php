<div class="off-canvas position-left light-off-menu" id="offCanvas-responsive" data-off-canvas>
    <div class="off-menu-close">
        <h3>Menu</h3>
        <span data-toggle="offCanvas-responsive"><i class="fa fa-times"></i></span>
    </div>
    <ul class="vertical menu off-menu" data-responsive-menu="drilldown">
        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a></li>
        <!-- <li>
            <a href="#"><i class="fa fa-magic"></i>Account</a>
            <ul class="submenu menu vertical" data-submenu data-animate="slide-in-down slide-out-up">
                <li><a href="{{ route('user.account.user') }}">
                        <i class="fa fa-magic"></i>My Account</a>
                </li>
                <li><a href="{{ route('user.account.edit') }}"><i class="fa fa-magic"></i>My Account Setting</a></li>
            </ul>
        </li> -->
        <li>
            <a href="#"><i class="fa fa-th"></i>Channel</a>
            {!! getFrontEndCategories() !!}
        </li>
        <li>
            <a href="{{ route('post.index') }}"><i class="fa fa-edit"></i>posts</a>
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
                <li><a href="{{ route('home') }}"><i class="fa fa-edit"></i>Blog</a></li>
                <li><a href="{{ route('contact') }}"><i class="fa fa-phone"></i>Contact</a></li>
                <li><a href="{{ route('about') }}"><i class="fa fa-info"></i>About</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    @if(Auth::user()->role->id == 1)
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-th"></i>Dashboard</a></li>
                    @endif
                    @if(Auth::user()->role->id == 2)
                        <li><a href="{{ route('author.dashboard') }}"><i class="fa fa-th"></i>Dashboard</a></li>
                    @endif
                @endguest
            </ul>
        </li>
    </ul>
    <div class="responsive-search">
        <form method="post">
            <div class="input-group">
                <input class="input-group-field" type="text" placeholder="search Here">
                <div class="input-group-button">
                    <button type="submit" name="search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="top-button">
        <ul class="menu">
            
        </ul>
    </div>
</div>