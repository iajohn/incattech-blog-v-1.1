@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $post->title,
        'type'          => 'articles',
        'url'           => route('post.details', $post->slug ),
        'image'         => asset('assets/uploads/post/'.$post->featuredImg),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title')
    {{ $post->title }}     
@endsection

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
        /*.ad-widget-wrap {
            display: block;
        }*/
        .bio-image {
            text-align: center;
            width: 100%;
            height: 100%;
        }
        .bio-image span.name {
            margin-left: 0px;
            padding: 50px 60px;
            background: #fff;
            border-radius: 50%;
            text-transform: uppercase;
            font-size: 50px;
            border: 1px solid;
            line-height: 157px;
        }
        .ad-widget-wrap {
            display: inline-block;
        }

        span.name {
            margin-left: 0px;
            padding: 5px 22px;
            background: #fff;
            border-radius: 50%;
            border: 1px solid;
            text-transform: uppercase;
            font-size: 20px;
            line-height: 41px;
            height: fit-content;
        }

        @media (min-width: 320px) and (max-width: 767px) {
              span.name {
                margin-left: 0px;
                padding: 0px 13px;
                background: #fff;
                border-radius: 50%;
                border: 1px solid;
                text-transform: uppercase;
                font-size: 15px;
                line-height: 41px;
                height: fit-content;
                /* width: unset; */
            }
        }
        

        
    </style>
@endpush

@section('content')
    <!-- Start Header Area -->
    @include('layouts.frontend.partial.global.front_header')
    <!-- End Header Area -->

    <!-- Start top-post Area -->
    <section class="top-post-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="hero-nav-area">
                        <!-- <h1 class="text-white">News Category</h1> -->
                        <p class="text-white link-nav">
                            <a href="{{ route('home') }}">Home </a>
                            <span class="lnr lnr-arrow-right"></span>
                            <a href="{{ route('post.index') }}">Posts </a>
                            <span class="lnr lnr-arrow-right"></span>
                            <a href="" class="active">{{ $post->title }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-post Area -->

    <!-- slider -->

    <!-- Start post-content Area -->
    <section class="post-content-area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 main-page posts-list">
                    <!-- <div class="col-lg-9 posts-list"> -->
                    <div class="single-post-blog row">
                        <div class="col-lg-12">
                            <div class="row tags">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="bottom pt-20 d-flex justify-content-between align-items-center flex-wrap">
                                        <div class="caty">
                                            <span class="fa fa-folder ml-0 mr-0 article-type"></span>
                                            <span class="ml-0">
                                                @foreach($post->categories as $cat)
                                                    <a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="primary-btn mr-10 mb-3 pl-1 pr-1">
                                                        {{ $cat->name }}
                                                    </a> 
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="feature-img">
                                @if($post->featuredImg)
                                    <img class="img-fluid" src="{{ asset('assets/uploads/post/'.$post->featuredImg) }}" alt="{{ $post->ImgCredit }}">
                                @else
                                    <div class="feature-img-article">
                                        <div class="feature-img-article-title"> {{ substr($post->title, 0) }}</div>
                                        <span class="feature-img-article-time"> {{ $post->created_at->toFormattedDateString() }} </span>
                                        <div class="feature-img-article-profile">
                                            <a class="name" href="{{ route('author.profile',$post->user->username) }}">
                                                <h5 class="text-white">
                                                    <b>{{ $post->user->username }}</b>
                                                </h5>
                                            </a>
                                            
                                            <!-- <span class="feature-img-article-time"> {{ $post->created_at->toFormattedDateString() }} </span> -->
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row t-pics tags">
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                    <div class="title heading">
                                        <h3 class="title">
                                            <a href=""><b>{{ $post->title }}</b></a>
                                        </h3>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 text-right hidden-xs">
                                    <div class="d-flex justify-content-end">
                                        @if($post->user->profile->profile_pics)
                                            <div class="mr-15">
                                                <a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
                                                    <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}" class="img-fluid img-circle">
                                                </a>
                                            </div>
                                        @else
                                            <span class="name"> {{ substr($post->user->username, 0, 1) }}</span>
                                        @endif
                                        <a class="name" href="{{ route('author.profile',$post->user->username) }}">
                                            <h5 class="text-white">
                                                <b>{{ $post->user->username }}</b>
                                            </h5>
                                        </a>
                                        
                                        <p>on {{ $post->created_at->toFormattedDateString() }}</p>
                                    </div>
                                </div>

                                <div class="visible-xs">
                                    <div class="d-flex justify-content-end">
                                        @if($post->user->profile->profile_pics)
                                            <div class="mr-15">
                                                <a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
                                                    <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}" class="img-fluid img-circle">
                                                </a>
                                            </div>
                                        @else
                                            <span class="name"> {{ substr($post->user->username, 0, 1) }}</span>
                                        @endif
                                        <a class="name" href="{{ route('author.profile',$post->user->username) }}">
                                            <h5 class="text-white">
                                                <b>{{ $post->user->username }}</b>
                                            </h5>
                                        </a>
                                        
                                        <p>on {{ $post->created_at->toFormattedDateString() }}</p>
                                    </div>
                                </div>

                                <!-- <div class="">
                                    <div class="d-flex justify-content-end">
                                        <div class="mr-15">
                                            <a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
                                                <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}" class="img-fluid img-circle">
                                            </a>
                                        </div>
                                        <div>
                                            <a class="name" href="{{ route('author.profile',$post->user->username) }}">
                                                <h5 class="text-white">
                                                    <b>{{ $post->user->username }}</b>
                                                </h5>
                                            </a>
                                            
                                            <p>on {{ $post->created_at->toFormattedDateString() }}</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <p class="excert">
                                {!! html_entity_decode($post->body) !!}
                            </p>

                            <div class="row tags ">
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-10">
                                    <div class="bottom pt-20 d-flex justify-content-between align-items-center flex-wrap">
                                        <div class="caty">
                                            <span class="fa fa-tag ml-0 mr-0 article-type"></span>
                                            <span class="ml-0">
                                                @foreach($post->tags as $cat)
                                                    <a href="{{ route('tag.posts', $cat->slug ) }}" class="primary-btn mr-10 mb-3 pl-1 pr-1">
                                                        {{ $cat->name }}
                                                    </a> 
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tag-details">
                        @include('layouts.frontend.partial.post.like-view')
                    </div>

                    <div class="portfolio mt-20 mb-20">
                        @include('layouts.frontend.partial.post.about-author')
                    </div>

                    <div class="navigation-area">
                        @include('layouts.frontend.partial.post.navigation')
                    </div>

                    <div class="comment-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading">               
                                    {{ __('Leave a Comment') }}
                                </div>
                            </div>  
                        </div>
                        @include('layouts.frontend.partial.post.disqus')

                    </div>
                </div>

                <!-- <div class="side-two"> -->
                @include('layouts.frontend.partial.sidebar.ads_side')
                <!-- </div> -->              
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- post-area -->

    @include('layouts.frontend.partial.post.alsoread')

    <!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->

@endsection

@push('js')
    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c641ac93a995141"></script>
@endpush