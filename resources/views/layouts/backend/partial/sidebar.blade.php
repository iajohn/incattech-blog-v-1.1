<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
   
    <div class="user-info">
        <div class="image">
            
        </div>
        @if(Auth::user()->profile->profile_pics)
            <img src="{{ asset(Auth::user()->profile->profile_pics) }}" width="48" height="48" alt="User" alt="{{ Auth::user()->name }}">
        @else
            <div class="profile__image1" style="background: #D8D8D8;width: 48px;height: 48px;line-height: 48px;text-align: center;
                 position: absolute;top: 5px;border-radius: 50%;border: 1px solid;text-transform:uppercase;">
                <span>{{ substr(Auth::user()->username, 0, 1) }}</span>
            </div>
        @endif
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                @if(Request::is('admin*'))
                    <ul class="dropdown-menu pull-right">
                        <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                <i class="material-icons">account_circle</i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li role="seperator" class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Sign Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endif

                @if(Request::is('author*'))
                    <ul class="dropdown-menu pull-right">
                        <li class="{{ Request::is('author/profile') ? 'active' : '' }}">
                            <a class="dropdown-item" href="{{ route('author.profile.index') }}">
                                <i class="material-icons">account_circle</i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li role="seperator" class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Sign Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                        

                 <li>
                    <a href="#userDropdown" aria-expanded="false" data-toggle="collapse"> 
                        <i class="material-icons">account_circle</i>
                        <span>{{ __('Manage Users') }}</span> <i class="material-icons pull-right">keyboard_arrow_down</i>
                    </a>
                    <ul id="userDropdown" class="collapse list-unstyled ">
                        <li class="{{ Request::is('admin/authors*') ? 'active' : '' }}">
                            <a href="{{ route('admin.author.index') }}">
                                <i class="material-icons">account_circle</i>
                                <span>Authors</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}">
                                <i class="material-icons">account_circle</i>
                                <span>Regular</span>
                            </a>
                        </li>                                  
                    </ul>
                </li>

                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tag.index') }}">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Category</span>
                    </a>
                </li>

                <li>
                    <a href="#postDropdown" aria-expanded="false" data-toggle="collapse"> 
                        <i class="material-icons">library_books</i>
                        <span>{{ __('Manage Posts') }}</span> <i class="material-icons pull-right">keyboard_arrow_down</i>
                    </a>
                    <ul id="postDropdown" class="collapse list-unstyled ">
                        <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.index') }}">
                                <i class="material-icons"></i>
                                <span>Posts</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.pending') }}">
                                <i class="material-icons"></i>
                                <span>Pending Posts</span>
                            </a>
                        </li>   

                        <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                            <a href="{{ route('admin.favorite.index') }}">
                                <i class="material-icons">favorite</i>
                                <span>Favorite Posts</span>
                            </a>
                        </li>                                    
                    </ul>
                </li>

                {{--<li class="{{ Request::is('admin/tv-tag*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tv-tag.index') }}">
                        <i class="material-icons">label</i>
                        <span>Tv Tag</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tv-channel*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tv-channel.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Tv Channel</span>
                    </a>
                </li>--}}

                <li>
                    <a href="{{ route('admin.tv.index') }}"> 
                        <i class="material-icons">face</i>
                        <span>{{ __('Manage TV') }}</span>
                    </a>
                    <!-- <ul id="tvDropdown" class="collapse list-unstyled ">
                        <li class="{{ Request::is('admin/tv*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tv.index') }}">
                                <i class="material-icons"></i>
                                <span>TV</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/pending/tv') ? 'active' : '' }}">
                            <a href="{{ route('admin.tv.pending') }}">
                                <i class="material-icons"></i>
                                <span>Pending TV</span>
                            </a>
                        </li>   

                        <li class="{{ Request::is('admin/favorite-tv') ? 'active' : '' }}">
                            <a href="{{ route('admin.favorite.tv') }}">
                                <i class="material-icons">favorite</i>
                                <span>Favorite TV</span>
                            </a>
                        </li>                                    
                    </ul> -->
                </li>

                
                <!-- <li class="{{ Request::is('admin/comments') ? 'active' : '' }}">
                    <a href="{{ route('admin.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li> -->

                <li>
                    <a href="#settingDropdown" aria-expanded="false" data-toggle="collapse"> 
                        <i class="material-icons">settings</i>
                        <span>{{ __('System Settings') }}</span> <i class="material-icons pull-right">keyboard_arrow_down</i>
                    </a>
                    <ul id="settingDropdown" class="collapse list-unstyled ">
                        <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                            <a href="{{ route('admin.subscriber.index') }}">
                                <!-- <i class="material-icons">subscriptions</i> -->
                                <span>Subscribers</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/company*') ? 'active' : '' }}">
                            <a href="{{ route('admin.company-settings') }}">
                                <!-- <i class="material-icons">settings</i> -->
                                <span>Settings</span>
                            </a>
                        </li>  
                        
                        <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a href="{{ route('admin.profile.index') }}">
                                <!-- <i class="material-icons">settings</i> -->
                                <!-- <span>Profile</span> -->
                            </a>
                        </li>                               
                    </ul>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="{{ route('author.post.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/favorite') ? 'active' : '' }}">
                    <a href="{{ route('author.favorite.index') }}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>

                <!-- <li class="{{ Request::is('author/comments') ? 'active' : '' }}">
                    <a href="{{ route('author.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li> -->
                <li class="{{ Request::is('author/profile') ? 'active' : '' }}">
                    <a href="{{ route('author.profile.index') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Profile</span>
                    </a>
                </li>
                
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>