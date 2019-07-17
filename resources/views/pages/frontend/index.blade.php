@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'		=>  config('app.name', 'Laravel'),
        'title'         => $title,
        'type'		    => 'blog',
        'url'			=> route('home') ,
        'image'         => asset('assets/frontend/themes/img/preview_dark.png'),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title','Home' . ' - Bringing you naratives on Fashion Tech and Wearables')

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/home/home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/placeholder.css') }}" rel="stylesheet">
    <style type="text/css"> 
    	.transition, .secondary-button, .secondary-button i, 
    	.hover-posts, .topBar .socialLinks a, .topBar .socialLinks a i, 
    	.top-button .menu li a, .top-button .menu li.dropdown-login 
    	.login-form input[type="submit"], .top-button .menu li.dropdown-login 
    	.login-form p a.newaccount, #navBar .top-bar .search-btn li.search i, 
    	#navBar .top-bar .search-btn li.upl-btn a, #navBar .topbar-full 
    	.search-bar-full .icon-btn i, #navBar .navBlack .topbar-light-dark 
    	.search-btn li.search i, #navBar .navBlack .topbar-light-dark 
    	.search-btn li.upl-btn a, #navBar .middleNav .search-btns li.search i, 
    	#navBar .middleNav .search-btns li.upl-btn a, #navBar .middleNav 
    	.search-btns li.login a, #premium .owl-carousel .item, #premium 
    	.owl-carousel .item figure.premium-img figcaption, .content .post 
    	.post-thumb .video-stats, .content .main-heading .tabs li.tabs-title a, 
    	.content .main-heading .tabs li.tabs-title:last-of-type a, footer 
    	.widgetBox .tagcloud a, footer .widgetBox .widgetContent form button[type="submit"], 
    	footer .widgetBox .widgetContent .secondary-button, .sidebar .widgetBox 
    	.widgetContent .profile-overview li a, .sidebar .widgetBox .tagcloud a, 
    	#carouselSlider .item .inner-item .item-title, .light-off-menu .off-social a, 
    	.light-off-menu .off-social a i, .dark-off-menu .top-button .menu li:first-of-type a, 
    	#breadcrumb .breadcrumbs li a, .SinglePostStats .media-object .author-des 
    	.subscribe button, .SinglePostStats .media-object .social-share .post-like-btn 
    	form button, .SinglePostStats .media-object .social-share .post-like-btn form button i, 
    	.singlePostDescription .description .inner-btn, .showmore_trigger span, .comments 
    	.comment-box .media-object .comment-textarea input[type="submit"], .main-comment 
    	.media-object .comment-desc .comment-btns span a, .main-comment .media-object 
    	.comment-desc .comment-btns span a i, .followers .follower button, .profile-inner 
    	.show-more-inner .show-more-btn, .profile-inner .profile-videos .profile-video 
    	.media-object .video-btns a.video-btn, .profile-inner .profile-videos .profile-video 
    	.media-object .video-btns a.video-btn i, .profile-inner .profile-videos .profile-video 
    	.media-object .video-btns button[type="submit"], .profile-inner .profile-videos 
    	.profile-video .media-object .video-btns button[type="submit"] i, .pagination a, 
    	.blog-post .blog-post-content a.blog-post-btn, .blog-post .blog-post-content 
    	.blog-post-extras .extras a, .blog-post .blog-post-content .blog-post-extras 
    	.extras .easy-share button[data-easyshare-button], .blog-post .blog-post-content 
    	.blog-post-extras .extras .easy-share button[data-easyshare-button] span, .blog-post 
    	.blog-post-content .blog-pagination a, .blog-post .blog-post-content .blog-pagination a i {
		    transition: all 0.5s ease;
		    -webkit-transition: all 0.5s ease;
		}
    	.single-post h4.lg-font {
		    font-size: 25px;
		    margin-top: 15px;
			margin-bottom: 15px;
		}
    	h4.lg-font p{
    		display: block !important;
    		font-size: 25px
    	}
    	.owl-item.active.center {
		    height: auto;
		}
		.hover-posts {
		    visibility: hidden;
		    display: block;
		    width: 100%;
		    height: 100%;
		    background: rgba(0, 0, 0, 0.7);
		    position: absolute;
		    z-index: 5;
		    top: 0;
		    text-align: center;
		    transform: scale(0);
		}
		.hover-posts span {
		    position: absolute;
		    top: 50%;
		    transform: translateY(-50%);
		    left: 0;
		    right: 0;
		    margin: 0 auto;
		    color: #fff;
		    font-size: 13px;
		    text-transform: capitalize;
		}
		.hover-posts span i {
		    color: #fff;
		    font-size: 18px;
		    display: block;
		    margin-bottom: 5px;
		}
		a.hover-posts {
		    visibility: visible;
		    transform: scale(1);
		}

		.skin-default .feature-img-art {
	        height: 135px;
	        width: auto;
	        border: 1px solid #ccc;
	        background: #ccc;
	        padding: 30px;
	    }

	    .skin-default div.feature-img-article-ti {
	        /*position: absolute;*/
	        padding: 30px;
	        background-color: #f9f9f9;
	        width: 100% !important;
	        height: auto;
	        text-transform: uppercase;
	        text-align: left;
	        border-right: 2px solid #fd0054;
	    }        

	    .skin-dark .feature-img-art {
	        height: 135px;
	        width: auto;
	        border: 1px solid #2e2e2e;
	        background: #2e2e2e;
	        padding: 30px;
	    }

	    .skin-dark div.feature-img-article-ti {
	        /*position: absolute;*/
	        padding: 30px;
	        background-color: #252525;
	        width: 100% !important;
	        height: auto;
	        text-transform: uppercase;
	        text-align: left;
	        border-right: 2px solid #fd0054;
	    }
    </style>
@endpush

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area">
		<div class="container-fluid">
			<div class="row">
				@include('layouts.frontend.partial.home.category_pick')					

				@include('layouts.frontend.partial.home.random_post_slider')
				
				{{--<div class="col-lg-6 col-md-8 owl-carousel active-banner owl-theme center-owl-nav" id="active-banner">
					@foreach($company as $setting)
						<div class="single-post m-c">
							<div class="thumb">
								<div class="relative">
									<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/banner/bc1.jpg') }}" alt="">
									<div class="overlay overlay-bg"></div>
								</div>
							</div>
							<div class="details">
								<div class="bottom d-flex justify-content-start align-items-center flex-wrap">
									<div>
										<a href="{{ route('home') }}" class="primary-btn" title="INCATTECH">{{ $setting->name }}</a>
										<a href="#"><span>March, 2019</span></a>
									</div>
									<!-- <div class="meta">
										<span class="lnr lnr-bubble"></span> 04
									</div> -->
								</div>
								<a href="{{ route('about') }}" title="{!! str_limit($setting->about_body, $limit = 82, $end = ' '.'...') !!}">
									<h4 class="lg-font">
				                            {!! str_limit($setting->about_body, $limit = 82, $end = ' '.'...') !!} </p>
									</h4>
								</a>
							</div>
						</div>
					@endforeach
				</div>--}}
				@include('layouts.frontend.partial.home.right-col')
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!-- Start Header Area -->
	@include('layouts.frontend.partial.global.front_header')
	<!-- End Header Area -->
	<section class="home int-news-area section-gap-top">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12 main-page">
					<!-- Start Latest News Area -->
					@include('layouts.frontend.partial.home.latest')
					<!-- End Latest News Area -->

					<!-- Start Instagram Area -->
					@include('layouts.frontend.partial.home.instagram')
				    <!-- End Instagram Area -->
				</div>
				<!-- <div class="side-one"> -->
				@include('layouts.frontend.partial.sidebar.home_sidebar')
				<!-- </div> -->
			</div>
		</div>
	</section>

	<!-- Start Categories Trending News Area -->
	@include('layouts.frontend.partial.home.trending')
	<!-- End Categories Trending News Area -->

	<!-- Start Categories Trending News Area -->
	@include('layouts.frontend.partial.home.videos')
	<!-- End Categories Trending News Area -->

	<!-- Start Editors Pick Area -->
	@include('layouts.frontend.partial.home.editorspick')
	<!-- End Editors Pick Area -->

	<!-- start footer Area -->
	@include('layouts.frontend.partial.global.front_footer')
	<!-- End footer Area -->
@endsection

@push('js')

@endpush