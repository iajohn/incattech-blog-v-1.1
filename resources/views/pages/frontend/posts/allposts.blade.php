@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'		=>  config('app.name', 'Laravel'),
        'title'         => 'All Blog Articles',
        'type'		    => 'articles',
        'url'			=> route('post.index'),
        'image'         => asset('assets/frontend/themes/img/incattech/logo.png'),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title','Posts')

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

    	.ad-widget-wrap {
		    display: inline-block;
		}

    	.skin-default span.name {
		    margin-left: 0px;
		    padding: 12px 18px;
		    background: #cccccc;
		    border-radius: 50%;
		    margin-right: 10px;
		    border: 1px solid #cccccc;
		    text-transform: uppercase;
		}

    	.skin-dark span.name {
		    margin-left: 0px;
		    padding: 12px 18px;
		    background: #2e2e2e;
		    border-radius: 50%;
		    margin-right: 10px;
		    border: 1px solid #2e2e2e;
		    text-transform: uppercase;
		}

		/*
			
		*/

		.page-item:first-child .page-link {
		    margin-left: 0;
		    border-top-left-radius: .25rem;
		    border-bottom-right-radius: .25rem;
		    border-top-right-radius: 50%;
		    border-bottom-left-radius: 50%;
		}

		.page-item:last-child .page-link {
		    border-top-left-radius: .25rem;
		    border-bottom-right-radius: .25rem;
		    border-top-right-radius: 50%;
		    border-bottom-left-radius: 50%;
		}
		
		.page-link {
		    position: relative;
		    display: block;
		    padding: .5rem .75rem;
		    margin-left: -1px;
		    line-height: 1.25;
		    color: #007bff;
		    border-radius: 50%;
		}

		.page-item {
		    margin: 0 5px;
		}
		.page-item.active .page-link {
		    z-index: 1;
		    color: #fff;
		    background-color: #FD0054;
		    border-color: #FD0054;
		    border-radius: 50px;
		}


		.skin-default .page-link{
			border: 1px solid #cccccc;
		}
		.skin-default .page-item.disabled .page-link {
		    color: #6c757d;
		    pointer-events: none;
		    cursor: auto;
		    background-color: #ccc;
		    border-color: #ccc;
		}
		.skin-default .page-link:focus {
		    z-index: 2;
		    outline: 0;
		    box-shadow: 0 0 0 .2rem rgb(208, 208, 208);
		}
		.skin-default .page-link:hover {
		    z-index: 2;
		    color: #fd0054;
		    text-decoration: none;
		    background-color: #ccc;
		    border-color: #ccc;
		    border-radius: 50%;
		}

		
		.skin-dark .page-item.disabled .page-link {
		    color: #6c757d;
		    pointer-events: none;
		    cursor: auto;
		    background-color: #2e2e2e;
		    border-color: #2e2e2e;
		}
		.skin-dark .page-link{
			border: 1px solid #657786;
		}
		.skin-dark .page-link:focus {
		    z-index: 2;
		    outline: 0;
		    box-shadow: 0 0 0 .2rem #657786;
		}
		.skin-dark .page-link:hover {
		    z-index: 2;
		    color: #fd0054;
		    text-decoration: none;
		    background-color: #2e2e2e;
		    border-color: #2e2e2e;
		    border-radius: 50%;
		}

		@media (min-width: 768px) and (max-width: 1024px) {
	        .skin-default span.name {
	            margin-left: 0px;
	            padding: 5px 16px;
	            background: #f9f9f9;
	            border-radius: 50%;
	            border: 1px solid;
	            text-transform: uppercase;
	            font-size: 20px;
	            line-height: 41px;
	            height: fit-content;
	            width: auto;
	        }

	        .skin-dark span.name {
	            margin-left: 0px;
	            padding: 5px 16px;
	            background: #252525;
	            border-radius: 50%;
	            border: 1px solid;
	            text-transform: uppercase;
	            font-size: 20px;
	            line-height: 41px;
	            height: fit-content;
	            width: auto;
	        }
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
    <!-- <link href="{{ asset('assets/frontend/themes/css/custom.css') }}" rel="stylesheet"> -->
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
                            	{{ __('All Posts') }} {{--( {{$posts->count()}} )--}}
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
						                                <span class="name"> {{ substr($post->user->username, 0, 1) }}</span>
						                            @endif
			                                        
			                                        <div class="name-date pt-2">
			                                        	<small>{{ __('Article by') }}</small>
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
						                                @if($post->featuredImg)
						                                    <img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/'.$post->featuredImg) }}" alt="{{ $post->ImgCredit }}">
						                                @else
						                                    <div class="feature-img-art">
						                                        <div class="feature-img-article-ti"> {{ substr($post->title, 0) }}</div>
						                                    </div>
						                                @endif
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
														<!-- <ul class="ml-0 mt-1">
															<li>
																<span class="fa fa-tag ml-0 mr-0 article-type"></span>
																@foreach($post->tags as $t)
																	<a href="{{ route('category.posts', [ 'slug' => $t->slug ]) }}" class="pl-1 pr-1">
																		{{ $t->name }}
																	</a> 
																@endforeach
															</li>
														</ul> -->
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								@else

							@endif
						</div>

						{{ $posts->links() }}
					</section>
					<!-- End Technology News Area -->
				</div>

				<!-- <div class="side-one"> -->
				@include('layouts.frontend.partial.sidebar.allpost_sidebar')
				<!-- </div> -->
			</div>
		</div>
	</div>
	<!-- End Main Area -->

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection