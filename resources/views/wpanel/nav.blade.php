<nav class="side-menu">
    <ul class="side-menu-list">

        <li class="blue">
            <a href="{{ route('admin.dashboard') }}">
                <i class="font-icon font-icon-dashboard"></i>
                <span class="lbl">Dashboard</span>
            </a>
        </li>

        <li class="purple with-sub">
            <span>
                <i class="font-icon font-icon-editor-video"></i>
                <span class="lbl">Videos</span>
            </span>
            <ul>
                <li><a href="{{ route('admin.tv.index') }}"><span class="lbl">All Videos</span></a></li>
                <li><a href="{{ route('admin.tv.create') }}"><span class="lbl">Add New Video</span></a></li>
                <li class="{{ Request::is('admin/pending/tv') ? 'active' : '' }}">
                    <a href="{{ route('admin.tv.pending') }}">
                        <span class="lbl">Pending TV</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tv.index') }}">
                        <span class="lbl">Favorite TV</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="purple with-sub">
            <span>
                <i class="font-icon font-icon-editor-video"></i>
                <span class="lbl">Video Playlists</span>
            </span>
            <ul>
                <li><a href="{{ route('admin.playlist.index') }}"><span class="lbl">Playlist</span></a></li>
                <li><a href="{{ route('admin.playlist.create') }}"><span class="lbl">Add New Playlist</span></a></li>
            </ul>
        </li>

        <li class="{{ Request::is('admin/tv-channel') ? 'blue-active' : 'blue' }}">
            <a href="{{ route('admin.tv-channel.index') }}">
                <i class="font-icon font-icon-"></i>
                <span class="lbl">Channels</span>
            </a>
        </li>

        <li class="purple with-sub">
            <span>
                <i class="font-icon font-icon-case-2"></i>
                <span class="lbl">Subscription</span>
            </span>
            <ul>
                <li><a href="{{ route('admin.subscription.form') }}"><span class="lbl">Add Subscription</span></a></li>
                <li><a href="{{ route('admin.subscription.index') }}"><span class="lbl">Subscription History</span></a></li>
            </ul>
        </li>


        {{--
            <li class="blue">
                <a href="#">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Community</span>
                </a>
            </li>
            <li class="purple with-sub">
                    <span>
                        <i class="font-icon font-icon-comments"></i>
                        <span class="lbl">Messages</span>
                    </span>
                <ul>
                    <li><a href="#"><span class="lbl">Inbox</span><span class="label label-custom label-pill label-danger">4</span></a></li>
                    <li><a href="#"><span class="lbl">Sent mail</span></a></li>
                    <li><a href="#"><span class="lbl">Bin</span></a></li>
                </ul>
            </li>
        --}}
    </ul>
</nav><!--.side-menu-->
