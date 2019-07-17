@extends('layouts.frontend.front_app')

@section('title')
    {{ $query }}
@endsection

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
        .single-post.post-body {
            border: 1px solid #5556;
        }

        .single-post.post-body:hover {
            box-shadow: 0px 0px 4px 0px #fd0054;
            border: 1px solid #222;
        }

        .single-post .a-avt{
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .single-post .a-avt a h5:hover{
            color: #fd0054 !important;
        }

        .skin-default span.name {
            margin-left: 0px;
            padding: 12px 12px;
            background: #cccccc;
            border-radius: 50%;
            margin-right: 10px;
            border: 1px solid #cccccc;
        }

        .skin-dark span.name {
            margin-left: 0px;
            padding: 12px 12px;
            background: #2e2e2e;
            border-radius: 50%;
            margin-right: 10px;
            border: 1px solid #2e2e2e;
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
                            <a href="{{ url('/') }}">Home </a>
                            <span class="lnr lnr-arrow-right"></span>
                            <a href="" class="active">
                                {{ __('Search Results') }} ( {{$posts->count()}} )
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-post Area -->

    <!-- Start Main Area -->
    <div class="category-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 main-page">
                    <div class="search-result">
                        Search results for keyword "{{ $query }}" found in {{ $posts->count() }} posts.
                    </div>

                    <section class="">
                        <div class="row">
                            @if($posts->count() > 0)
                                @foreach($posts as $post)
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="single-post single-int lsm mb-40 post-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <div class="d-flex justify-content-start a-avt">
                                                    @if($post->user->profile->profile_pics)
                                                        <div class="mr-15">
                                                            <a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
                                                                <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}" class="img-fluid img-circle">
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="name"> {{ substr($post->user->firstname, 0, 1) }} {{ substr($post->user->lastname, 0, 1) }} </span>
                                                    @endif
                                                    <div class="name-date pt-2">
                                                        <small> {{ __('Article by') }} </small>
                                                        <a class="name" href="{{ route('author.profile',$post->user->username) }}">
                                                            <span class="text-white">
                                                                @guest
                                                                    {{ $post->user->username }}
                                                                @else
                                                                    @if(Auth::user()->username == $post->user->username ) 
                                                                        You
                                                                        @else 
                                                                            {{ $post->user->username }}
                                                                    @endif
                                                                @endguest
                                                            </span>
                                                        </a>
                                                        
                                                        <small> on {{ $post->created_at->toFormattedDateString() }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="thumb small">
                                                <div class="relative">
                                                    <img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$post->featuredImg) }}" alt="">
                                                    <div class="overlay overlay-bg"></div>
                                                </div>
                                            </div>

                                            <div class="details e-pick">
                                                <a href="{{ route('post.details', [ 'slug' => $post->slug ]) }}">
                                                    <h4 class="">
                                                        {{ $post->title }}
                                                    </h4>
                                                </a>
                                            </div>

                                            <div class="">
                                                <div class="bottom pt-20 d-flex justify-content-between align-items-center flex-wrap">
                                                    <div class="caty">
                                                        <span class="fa fa-folder ml-0 mr-0 article-type"></span>
                                                        <span class="ml-0">
                                                            @foreach($post->categories as $cat)
                                                                <a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="pl-1 pr-1">
                                                                    {{ $cat->name }}
                                                                </a> 
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                            @endif
                        </div>

                        {{--{!! $posts->render() !!}--}}
                    </section>
                    <!-- End Technology News Area -->
                </div>

                @include('layouts.frontend.partial.sidebar.ads_side')
            </div>
        </div>
    </div>
    <!-- End Main Area -->

    <!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection