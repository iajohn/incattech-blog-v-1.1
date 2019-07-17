@extends('layouts.dev.master')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'nofollow',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $video->video_title,
        'type'          => 'videos',
        'url'           => route('tv.details', $video->video_slug),
        'image'         => asset($video->video_cover_location),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      => $video->video_title.','.' Incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title')
    {{ $video->video_title }}
@endsection

@push('css')
    <style type="text/css">
        .vizew-pager-prev,
        .vizew-pager-next {
          position: fixed;
          z-index: 100;
          top: 50%;
          left: 0;
          width: 60px;
          -webkit-transform: translateY(-50%);
          -ms-transform: translateY(-50%);
          transform: translateY(-50%); }
          .vizew-pager-prev p,
          .vizew-pager-next p {
            box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
            -webkit-transition-duration: 500ms;
            -o-transition-duration: 500ms;
            transition-duration: 500ms;
            cursor: pointer;
            position: absolute;
            width: 270px;
            height: 60px;
            background-color: #181b1b;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 2px;
            color: #ffffff;
            line-height: 60px;
            text-transform: uppercase;
            text-align: center;
            color: #ffffff;
            top: 41%;
            margin-bottom: 0;
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
            left: -105px;
            z-index: 1; }
            @media only screen and (max-width: 767px) {
              .vizew-pager-prev p,
              .vizew-pager-next p {
                width: 220px;
                height: 40px;
                font-size: 14px;
                left: -90px;
                line-height: 40px; } }
          .vizew-pager-prev:hover,
          .vizew-pager-next:hover {
            width: 500px; }
            @media only screen and (max-width: 767px) {
              .vizew-pager-prev:hover,
              .vizew-pager-next:hover {
                width: 300px; } }
            .vizew-pager-prev:hover .pager-article,
            .vizew-pager-next:hover .pager-article {
              opacity: 1;
              visibility: visible; }

        .vizew-pager-next {
          right: 0;
          left: auto; }
          .vizew-pager-next p {
            left: auto;
            right: -105px; }
            @media only screen and (max-width: 767px) {
              .vizew-pager-next p {
                right: -90px; } }

        
        .single-feature-post.video-post {
          position: relative;
          z-index: 1;
          width: 100%;
          height: 500px; }
          @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .single-feature-post.video-post {
              height: 400px; } }
          @media only screen and (min-width: 768px) and (max-width: 991px) {
            .single-feature-post.video-post {
              height: 350px; } }
          @media only screen and (max-width: 767px) {
            .single-feature-post.video-post {
              height: 320px; } }
          .single-feature-post.video-post::before {
            content: "";
            position: absolute;
            height: 50%;
            width: 100%;
            z-index: 5;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            background: -webkit-linear-gradient(bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.01) 90%, rgba(0, 0, 0, 0) 100%);
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.01) 90%, rgba(0, 0, 0, 0) 100%); }
          .single-feature-post.video-post .play-btn {
            position: absolute;
            margin-top: -30px;
            margin-left: -30px;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            background-color: #db4437;
            border-radius: 50%;
            color: #ffffff;
            line-height: 60px;
            text-align: center;
            padding: 0 0 0 3px;
            z-index: 99; }
            @media only screen and (max-width: 767px) {
              .single-feature-post.video-post .play-btn {
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 20px; } }
            .single-feature-post.video-post .play-btn:hover, .single-feature-post.video-post .play-btn:focus {
              background-color: #0f1112; }
          .single-feature-post.video-post .post-content {
            position: absolute;
            left: 30px;
            bottom: 30px;
            z-index: 59;
            width: 80%; }
            @media only screen and (max-width: 767px) {
              .single-feature-post.video-post .post-content {
                left: 15px;
                bottom: 15px; } }
            .single-feature-post.video-post .post-content .post-title {
              font-size: 24px;
              display: block;
              color: #ffffff;
              margin-bottom: 10px; }
              @media only screen and (min-width: 768px) and (max-width: 991px) {
                .single-feature-post.video-post .post-content .post-title {
                  font-size: 18px; } }
              @media only screen and (max-width: 767px) {
                .single-feature-post.video-post .post-content .post-title {
                  font-size: 16px; } }
              .single-feature-post.video-post .post-content .post-title:hover, .single-feature-post.video-post .post-content .post-title:focus {
                color: #0f1112; }
            .single-feature-post.video-post .post-content .post-meta {
              position: relative;
              z-index: 1; }
              .single-feature-post.video-post .post-content .post-meta a {
                display: inline-block;
                margin-right: 30px;
                color: #ffffff; }
                .single-feature-post.video-post .post-content .post-meta a:hover, .single-feature-post.video-post .post-content .post-meta a:focus {
                  color: #db4437; }
            .single-feature-post.video-post .video-duration {
                display: inline-block;
                position: absolute;
                right: 30px;
                bottom: 30px;
                background-color: #0f1112;
                padding: 6px 12px;
                border-radius: 2px;
                font-size: 14px;
                color: #ffffff;
                line-height: 1;
                z-index: 79; 
            }

        .pager-article {
              box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
              -webkit-transition-duration: 500ms;
              -o-transition-duration: 500ms;
              transition-duration: 500ms;
              position: relative;
              z-index: 1;
              width: 500px !important;
              height: 320px !important;
              z-index: 9999;
              opacity: 0;
              visibility: hidden; }
              @media only screen and (max-width: 767px) {
                .pager-article {
                  width: 300px !important;
                  height: 220px !important; } }
              .pager-article .post-title {
                font-size: 20px !important; }
                @media only screen and (max-width: 767px) {
                  .pager-article .post-title {
                    font-size: 14px !important; } }

        .bg-img {
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .post-cata {
              background-color: #db4437;
              padding: 8px 15px 6px;
              border-radius: 2px;
              font-size: 12px;
              letter-spacing: 1px;
              text-transform: uppercase;
              border: none;
              color: #ffffff;
              line-height: 1;
              margin-bottom: 15px;
              display: inline-block; }
              .post-cata.cata-success {
                background-color: #3cb878; }
              .post-cata.cata-danger {
                background-color: #db4437; }
              .post-cata.cata-primary {
                background-color: #1996ce; }
              .post-cata:hover, .post-cata:focus {
                background-color: #0f1112;
                font-size: 12px; }
              .post-cata.cata-sm {
                font-size: 10px; }
                .post-cata.cata-sm:hover, .post-cata.cata-sm:focus {
                  background-color: #0f1112;
                  font-size: 10px; }

    </style>
@endpush

@section('content')
    <!--breadcrumbs-->
    <section id="breadcrumb" class="breadMargin" style="background-color: #f0f0f0">
    </section>
    <!--end breadcrumbs-->

    <!-- ##### Pager Area Start ##### -->
    <div class="vizew-pager-area">
        <div class="vizew-pager-prev">
            @if($prev)
                <p>PREVIOUS ARTICLE</p>
                <!-- Single Feature Post -->
                <div class="single-feature-post video-post bg-img pager-article" 
                     style="background-image: url({{ asset('assets/uploads/tv/'.$prev->featuredImg) }});">
                    <!-- Post Content -->
                    <div class="post-content">
                        <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                        <a href="{{ route('tv.details', $prev->slug) }}" class="post-title">
                            {{ $prev->video_title}}
                        </a>
                        <div class="post-meta d-flex">
                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 18</a>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 32</a>
                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 24</a>
                        </div>
                    </div>
                    <!-- Video Duration -->
                    <span class="video-duration">11.13</span>
                </div>
            @endif
        </div>

        <div class="vizew-pager-next">
            @if($next)
                <p>NEXT ARTICLE</p>
                <!-- Single Feature Post -->
                <div class="single-feature-post video-post bg-img pager-article" 
                     style="background-image: url({{ URL::asset($next->video_cover_location) }});">
                    <!-- Post Content -->
                    <div class="post-content">
                        <a href="#" class="post-cata cata-sm cata-success"> </a>
                        <a href="{{ route('tv.details', $next->video_slug) }}" class="post-title">
                            {{ $next->video_title }}
                        </a>
                        <div class="post-meta d-flex">
                            <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('j F y',
                                        strtotime($next->created_at)) }}</a>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> {!! kilomega($next->video_views) !!} views</a>
                            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> {!! kilomega($next->video_favorites) !!}</a>
                        </div>
                    </div>
                    <!-- Video Duration -->
                    <span class="video-duration"></span>
                </div>
            @endif
        </div>
    </div>
    <!-- ##### Pager Area End ##### -->

    <!-- full width Video -->
    <section class="fullwidth-single-video"
             style="background-image:url('{{ asset($video->video_cover_location) }}')">
        <div class="row">
            <div class="large-12 columns">
                <div class="flex-video widescreen">
                    @if($video->video_access == "guest")
                        {!! getVideoPlayer($video) !!}
                    @elseif($video->video_access == "registered" and Auth::check())
                        {!! getVideoPlayer($video) !!}
                    @elseif(($video->video_access == "subscriber" and $subscription_status)
                        or (Auth::check() and Auth::user()->role_id == 1) or (Auth::check() and Auth::user()->role_id == 2))
                        {!! getVideoPlayer($video) !!}
                    @elseif($video->video_access == "subscriber" and Auth::check())
                        <div id="subscribers_only">
                            <h2>Sorry, this video is only available to Subscribers</h2>
                            <div class="clear"></div>
                            <form method="get" action="/user/subscribe">
                                <button id="button">Subscribe now! </button>
                            </form>
                        </div>
                    @else
                        <div id="subscribers_only">
                            <h2>Sorry, this video is only available to Subscribers</h2>
                            <div class="clear"></div>
                            <form method="get" action="/register">
                                <button id="button">Signup Now to Become a Subscriber</button>
                            </form>
                        </div>
                    @endif
                    {{--{!! getVideoPlayer($video) !!}--}}
                </div>
            </div>
        </div>
    </section>

<div class="row">
    <!-- left side content area -->
    <div class="large-8 columns">
        <!-- single post stats -->
        <section class="SinglePostStats">
            <!-- newest video -->
            <div class="row secBg">
                <div class="large-12 columns">
                    <div class="media-object stack-for-small">
                        <div class="media-object-section object-second">
                            <div class="author-des clearfix">
                                <div class="post-title">
                                    <h4>{{ $video->video_title }}</h4>
                                    <p>
                                        <span><i class="fa fa-clock-o"></i>{{ date('j F y',
                                        strtotime($video->created_at)) }}</span>
                                        <span><i class="fa fa-eye"></i>
                                            {!! kilomega($video->video_views) !!} views
                                        </span>
                                        <span><i class="fa fa-heart"></i>
                                            <span id="favoritescount">{!! kilomega($video->video_favorites) !!}</span>
                                        </span>
                                    </p>
                                </div>
                                <div class="subscribe">
                                    <a class="favorite @if($video->isFavourite){{ 'active' }}@endif"
                                       href="javascript:void(0)"
                                       data-authenticated=
                                       "@if(Auth::check()){{Auth::user()->id}}@endif"
                                       data-videoid="{{ $video->id }}">
                                        <i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="social-share">
                                <div class="post-like-btn clearfix">
                                    <div class="float-right easy-share" data-easyshare data-easyshare-http data-easyshare-url="{{ Request::url() }}">
                                        <!-- Total -->
                                        <button data-easyshare-button="total">
                                            <span>Total</span>
                                        </button>
                                        <span data-easyshare-total-count>0</span>

                                        <!-- Facebook -->
                                        <button data-easyshare-button="facebook">
                                            <span class="fa fa-facebook"></span>
                                            <!-- <span>Share</span> -->
                                        </button>
                                        <span data-easyshare-button-count="facebook">0</span>

                                        <!-- Twitter -->
                                        <button data-easyshare-button="twitter" data-easyshare-tweet-text="">
                                            <span class="fa fa-twitter"></span>
                                            <!-- <span>Tweet</span> -->
                                        </button>
                                        <span data-easyshare-button-count="twitter">0</span>

                                        <!-- Instagram -->
                                        <button data-easyshare-button="instagram" data-easyshare-tweet-text="">
                                            <span class="fa fa-instagram"></span>
                                            <!-- <span>Share</span> -->
                                        </button>
                                        <span data-easyshare-button-count="instagram">0</span>

                                        <!-- Instagram -->
                                        <button data-easyshare-button="whatsapp" data-easyshare-tweet-text="">
                                            <span class="fa fa-whatsapp"></span>
                                            <!-- <span>Share</span> -->
                                        </button>
                                        <span data-easyshare-button-count="whatsapp">0</span>

                                        <!-- Google+ -->
                                        <button data-easyshare-button="google">
                                            <span class="fa fa-google-plus"></span>
                                            <!-- <span>+1</span> -->
                                        </button>
                                        <span data-easyshare-button-count="google">0</span>

                                        <div data-easyshare-loader>Loading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End single post stats -->

        <!-- single post description -->
        <section class="singlePostDescription">
            <div class="row secBg">
                <div class="large-12 columns">
                    <div class="heading">
                        <h5>Description</h5>
                    </div>
                    <div class="description showmore_one">
                        <p> {!! $video->video_details !!}  </p>
                        <div class="tags">
                            <button><i class="fa fa-tags"></i>Tags</button>
                            @foreach($tags as $tag)
                                <a href="#" class="inner-btn">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End single post description -->

        <section class="content comments">
            <div class="row secBg">
                <div class="large-12 columns">
                    <div class="main-heading borderBottom">
                        <div class="row padding-14">
                            <div class="medium-12 small-12 columns">
                                <div class="head-title">
                                    <i class="fa fa-comments"></i>
                                    <h4>Comments</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-comment">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- end left side content area -->
    <!-- sidebar -->
    <div class="large-4 columns">
        <aside class="secBg sidebar">
            <div class="row">
                <!-- search Widget -->
                <div class="large-12 medium-7 medium-centered columns">
                    <div class="widgetBox">
                        <div class="widgetTitle">
                            <h5>Search Videos</h5>
                        </div>
                        <form id="searchform" action="{{ url("/tv/search/all") }}" method="get" role="search">
                            <div class="input-group">
                                <input class="input-group-field" name="search"
                                       type="text" placeholder="Enter your keyword">
                                <div class="input-group-button">
                                    <input type="submit" class="button" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End search Widget -->

                <!-- most view Widget -->
                <div class="large-12 medium-7 medium-centered columns">
                    <div class="widgetBox">
                        <div class="widgetTitle">
                            <h5>Most View Videos</h5>
                        </div>
                        <div class="widgetContent">
                            @include('layouts.dev.partial.mostviewvideo')
                        </div>
                    </div>
                </div><!-- end most view Widget -->
                <!-- Recent post videos -->
                <div class="large-12 medium-7 medium-centered columns">
                    <div class="widgetBox">
                        <div class="widgetTitle">
                            <h5>Recent post videos</h5>
                        </div>
                        <div class="widgetContent">
                            @include('layouts.dev.partial.recentvideos')
                        </div>
                    </div>
                </div><!-- End Recent post videos -->
                <!-- tags -->
                <div class="large-12 medium-7 medium-centered columns">
                    <div class="widgetBox">
                        <div class="widgetTitle">
                            <h5>Tags</h5>
                        </div>
                        <div class="tagcloud">
                            @include('layouts.dev.partial.systemtags')
                        </div>
                    </div>
                </div><!-- End tags -->
            </div>
        </aside>
    </div><!-- end sidebar -->
</div>
@endsection
