@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <!-- Posts -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.post.index') }}">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">TOTAL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.category.index') }}">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">CATEGORIES</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.tag.index') }}">
                        <div class="icon">
                            <i class="material-icons">labels</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">TAGS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- Favorites Posts-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.favorite.index') }}">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">POSTS HEARTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ Auth::user() ->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- All Editor's Pick Posts -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.post.index') }}">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">EDITOR'S</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_editors_pick }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- Total Posts Views -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">All POSTS VIEWS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- All Authors -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-zoom-effect">
                    <a href="{{ route('admin.author.index') }}">
                        <div class="icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">TOTAL AUTHOR</div>
                        <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            
            <!-- Authors Added Today -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">                
                <div class="info-box bg-orange hover-zoom-effect">
                    <a href="{{ route('admin.author.index') }}">
                        <div class="icon">
                            <i class="material-icons">fiber_new</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">TODAY AUTHOR</div>
                        <div class="number count-to" data-from="0" data-to="{{ $new_authors_today }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- All Published Posts -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.post.index') }}">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">PUBLISHED</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <!-- Authors Added Today -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">                
                <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.author.index') }}">
                        <div class="icon">
                            <i class="material-icons">fiber_new</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">ACTIVE GUESTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $numberOfGuests }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <!-- All Published Posts -->
                <!-- <div class="info-box bg-pink hover-zoom-effect">
                    <a href="{{ route('admin.post.index') }}">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">PUBLISHED</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div> -->

                <!-- Pending Posts -->
                <div class="info-box bg-red hover-zoom-effect">
                    <a href="{{ route('admin.post.pending') }}">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">PENDING POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>

                        <!-- ===================== -->
                        <!-- ======  VIDEOS ====== -->
                        <!-- ===================== -->
                <!-- Total Videos -->
                <div class="info-box bg-purple hover-zoom-effect">
                    <a href="{{ route('admin.tv.index') }}">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">TOTAL VIDEOS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_videos->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <!-- Total Video Views -->
                <div class="info-box bg-purple hover-zoom-effect">
                    <a href="">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">VIDEOS VIEWS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_video_views }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <!-- PUBLISHED VID -->
                <div class="info-box bg-purple hover-zoom-effect">
                    <a href="{{ route('admin.tv.index') }}">
                        <div class="icon">
                            <i class="material-icons">labels</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">PUBLISHED VIDS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $videos->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <!-- Featured Video Count -->
                <div class="info-box bg-purple hover-zoom-effect">
                    <a href="{{ route('admin.tv.index') }}">
                        <div class="icon">
                            <i class="material-icons">labels</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">FEATURED VIDS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $featuredVideo_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <!-- Pending Videos -->
                <!-- <div class="info-box bg-red hover-zoom-effect">
                    <a href="{{ route('admin.tv.pending') }}">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">PENDING VIDS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_pending_videos }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div> -->

                <!-- VID CHANNELS -->
                <div class="info-box bg-purple hover-zoom-effect">
                    <a href="{{ route('admin.tv-channel.index') }}">
                        <div class="icon">
                            <i class="material-icons">labels</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">VID CHANNELS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $channel_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <!-- <div class="info-box bg-purple hover-zoom-effect">
                    <a href="{{ route('admin.tv.index') }}">
                        <div class="icon">
                            <i class="material-icons">labels</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">VID TAG</div>
                        <div class="number count-to" data-from="0" data-to="{{--{{ $vidtag_count }}--}}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div> -->
            </div>

            <!-- MOST POPULAR POST -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="header">
                        <h2>MOST POPULAR POST</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <!-- <th>Comments</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,'20') }}</td>
                                            <td>{{ $post->user->username }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorite_to_users_count }}</td>
                                            <!-- <td>{{ $post->comments_count }}</td> -->
                                            <td>
                                                @if($post->status == true)
                                                    <span class="label bg-green">Published</span>
                                                @else
                                                    <span class="label bg-red">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary waves-effect" target="_blank" href="{{ route('post.details',$post->slug) }}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOST POPULAR VIDEO -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="header">
                        <h2>MOST POPULAR VIDEO</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_videos as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->video_title,'20') }}</td>
                                            <td>{{ $post->user->username }}</td>
                                            <td>{{ $post->video_views }}</td>
                                            <td>{{ $post->video_favorites }}</td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="label bg-green">Published</span>
                                                @else
                                                    <span class="label bg-red">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary waves-effect" target="_blank" href="{{ route('tv.details',$post->video_slug) }}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>TOP 10 ACTIVE GUEST</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>Rank List</th>
                                        <th>Ip Address</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($active_guests->count() > 0)
                                            @foreach($active_guests as $key=>$guestUsers)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $guestUsers->ip_address }}</td>
                                                    <td>{{ $guestUsers->user_agent }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                              <tr>
                                                  <th colspan="5" class="alert alert-info text-center">
                                                      There are no guests users at the moment!
                                                  </th>                   
                                              </tr>
                                        @endif
                                    </tbody>
                                    <thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>TOP 10 ACTIVE AUTHOR</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>Rank List</th>
                                        <th>Full Name</th>
                                        <th>Posts</th>
                                        <!-- <th>Comments</th> -->
                                        <th>Favorite</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($active_authors as $key=>$author)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $author->firstname }} {{ $author->lastname }}</td>
                                                <td>{{ $author->posts_count }}</td>
                                                <!-- <td>{{ $author->comments_count }}</td> -->
                                                <td>{{ $author->favorite_posts_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="assets/backend/plugins/flot-charts/jquery.flot.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="assets/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush