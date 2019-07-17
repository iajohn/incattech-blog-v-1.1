@extends('layouts.dev.master')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/profile/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/placeholder.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/default/main.css') }}" rel="stylesheet">
@endpush

@section('content')
        <!--breadcrumbs-->
        <section id="breadcrumb">
            <div class="row">
                <div class="large-12 columns">
                    <nav aria-label="You are here:" role="navigation">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home"></i><a href="{{ route('tv') }}">Home</a></li>
                            <li>
                                <span class="show-for-sr">Current: </span> {{ $user->username }}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <!--end breadcrumbs-->
        <section class="topProfile">
            <div class="profile-stats">
                <div class="row secBg">
                    <div class="large-12 columns">
                        <div class="profile-author-img float-left">
                            @if($user->profile->profile_pics)
                                <img src="{{ asset($user->profile->profile_pics) }}" alt="profile author img">
                            @else
                                <span>{{ substr($user->username, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="clearfix">
                            <div class="profile-author-name float-left">
                                <h4>{{ $user->firstname }} {{ $user->lastname }}</h4>
                                <p>Join Date : <span>{{ date('j F y', strtotime($user->created_at)) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End profile top section -->
        <div class="row">
            @include('pages.frontend.account.sidenav')
            <!-- right side content area -->
            <div class="large-8 columns profile-inner">
                <!-- single post description -->
                <section class="profile-videos">
                    <div class="row secBg">
                        <div class="featured-author-count">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item item">
                                    <a class="nav-link" href="#fav-post" data-toggle="tab">
                                        <i class="fa fa-heart"></i>
                                        <div class="name">
                                                
                                            @guest
                                                {{ $user->username }}'s Heart Article List 
                                            @else
                                                @if(Auth::user()->username == $user->username) 
                                                    Your Heart Lists
                                                        @else 
                                                            {{ $user->username }}'s Heart List
                                                @endif
                                            @endguest
                                        </div>
                                        <div class="value">{{ $fav_posts->count() }}</div>
                                    </a>
                                </li>

                                <li class="nav-item item">
                                    <a class="nav-link" href="#fav-video" data-toggle="tab">
                                        <i class="fa fa-heart"></i>
                                        <div class="name">
                                                
                                            @guest
                                                {{ $user->username }}'s Heart Video List 
                                            @else
                                                @if(Auth::user()->username == $user->username) 
                                                    Your Heart Lists
                                                        @else 
                                                            {{ $user->username }}'s Heart List
                                                @endif
                                            @endguest
                                        </div>
                                        <div class="value">{{ $fav_posts->count() }}</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                                            
                        <div class="tab-content">
                            <div class="tab-pane active" id="fav_post">
                                <div class="row secBg">
                                    <div class="large-12 columns">
                                        <div class="heading">
                                            <i class="fa fa-video-camera"></i>
                                            <h4>My Favorites</h4>
                                        </div>
                                        @if($favorites->isEmpty())
                                            <div data-abide-error="" class="alert callout" style="display: block;">
                                                <p><i class="fa fa-exclamation-triangle"></i> No Videos Yet</p>
                                            </div>
                                        @else
                                            @foreach($favorites as $favorite)
                                                <div class="profile-video">
                                                    <div class="media-object stack-for-small">
                                                        <div class="media-object-section media-img-content"
                                                             style="display: table-cell;">
                                                            <div class="video-img">
                                                                <img src="{{ URL::asset($favorite->video_cover_location) }}"
                                                                     alt="{{ $favorite->video_title }}" />
                                                            </div>
                                                        </div>
                                                        <div class="media-object-section media-video-content"
                                                             style="display: table-cell;">
                                                            <div class="video-content">
                                                                <h5>
                                                                    <a href="{{ url('/tv/'.$favorite->video_slug) }}">
                                                                        {{ str_limit($favorite->video_title, 100) }}</a>
                                                                </h5>
                                                                <p>{{ str_limit($favorite->video_desc, 200) }}</p>
                                                            </div>
                                                            <div class="video-detail clearfix">
                                                                <div class="video-stats">
                                                                    <span><i class="fa fa-clock-o"></i>{{ date('j F y', strtotime($favorite->created_at)) }}</span>
                                                                    <span><i class="fa fa-eye"></i>{!! kilomega($favorite->video_views) !!}</span>
                                                                </div>
                                                                <div class="video-btns">
                                                                    <a class="favorite active" href="javascript:void(0)">
                                                                        <i class="fa fa-heart"></i> Favorite</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        <div class="tab-pane fade" id="fav-video">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="heading">
                                        <i class="fa fa-file-o"></i>
                                        <h4>My Favorites</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- End single post description -->
            </div><!-- end left side content area -->
        </div>
@endsection

@push('js')
    
@endpush