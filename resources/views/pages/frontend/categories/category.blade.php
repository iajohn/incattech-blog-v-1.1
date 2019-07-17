@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $title,
        'type'          => 'articles',
        'url'           => route('category.posts', $category->slug ),
        'image'         => asset('assets/uploads/category/slider/'.$category->featuredImg),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $category->name . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title',$title)

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
    	.single-post.post-body {
		    border: 1px solid #5556;
		}

		.single-post.post-body:hover {
            box-shadow: 0px 5px 15px rgba(86, 86, 86, 0.46);}

    	.single-post .a-avt a h5:hover{
    		color: #fd0054 !important;
    	}

    	.ad-widget-wrap {
            display: inline-block;
        }

    	.single-post .e-pick{
    		text-align: center;
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
                            <a href="" class="active">
                            	{{ $category->name }} ( {{$posts->count()}} )
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
				<div id="editorspick" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 owl-carousel owl-theme">
					@if ($categories_pick->count() > 0)
						@foreach($categories_pick as $pick)
							<div class="single-post single-int  editorspick-post">
								<a class="" href="{{ route('category.posts', [ 'slug' => $pick->slug ]) }}">
									<div class="thumb">
										<div class="relative">
											<img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/category/slider/'.$pick->featuredImg) }}" alt="">
											<div class="overlay overlay-bg"></div>
										</div>
									</div>
								</a>

								<div class="details e-pick">
									<a class="success-btn" href="{{ route('category.posts', [ 'slug' => $pick->slug ]) }}">
		                            	{{ $pick->name }}
		                            </a>
								</div>
							</div>
						@endforeach
						@else
							<div class="e-pick-alert">
		                        <div class="alert alert-info text-center">
		                            {{ __("There are no category here at the moment check later!") }}
		                        </div>                   
		                    </div>
					@endif
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
					<!-- Start Technology News Area -->
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
													<img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$post->featuredImg) }}" alt="">
													<div class="overlay overlay-bg"></div>
												</div>
											</div>

											<div class="details e-pick text-left pt-2">
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
																<a href="{{ route('category.posts', [ 'slug' => $category->slug ]) }}" class="pl-1 pr-1">
																	{{ $category->name }}
																</a> 
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								@else
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="e-pick-alert">
								            <div class="alert alert-info text-center">
								                {{ __("There are no posts in")}} {{ $category->name }} {{__("category at the moment check later!") }}
								            </div>                   
								        </div>
								    </div>
							@endif
						</div>
					</section>
					<!-- End Technology News Area -->
				</div>

				<!-- <div class="side-one"> -->
				@include('layouts.frontend.partial.sidebar.home_sidebar')
				<!-- </div> -->
			</div>
		</div>
	</div>
	<!-- End Main Area -->

	<section class="int-news-area section-gap-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2 class="title heading">Editor's Pick</h2>
							</div>
						</div>
					</div>

					<div class="row">
						<div id="owl-carousel-1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 owl-carousel owl-theme">
							@if ($editors_pick->count() > 0)
								@foreach($editors_pick as $posts)
									<div class="single-post post-body">
									<article class="article single-post">
										<div class="article-img thumb small">
											<div class="relative">
												<a href="">
													<img src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg) }}" alt="">
												</a>
												<div class="overlay overlay-bg"></div>
											</div>
										</div>
										<div class="details article-body">
											<h4 class="article-title">
												<a href="">{{ $posts->title }}</a>
											</h4>
										</div>

										<ul class="article-info pl-2 pr-2">
											<ul class="article-meta">
												<li>
													<small>
						                        		posted on {{ $posts->created_at->toFormattedDateString() }}
						                        	</small>
						                        </li>

												<li>
													@guest
						                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
						                                    closeButton: true,
						                                    progressBar: true,
						                                })">
						                                	<span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
						                                </a>
						                            @else
						                                <a 	href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $posts->id }}').submit();"
						                                   	class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'favorite_posts' : ''}}">
						                                   	<span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
						                                </a>

						                                <form id="favorite-form-{{ $posts->id }}" method="POST" action="{{ route('post.favorite',$posts->id) }}" style="display: none;">
						                                    @csrf
						                                </form>
						                            @endguest
												</li>
											</ul>
											<div class="bottom pt-20 d-flex justify-content-between align-items-center flex-wrap">
												<div class="p-0 caty">
													<span class="fa fa-folder ml-0 mr-0 article-type"></span>
													<span class="ml-0">
														@foreach($posts->categories as $cat)
															<a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="pl-1 pr-1">
																{{ $cat->name }}
															</a> 
														@endforeach
													</span>
												</div>
											</div>
										</ul>
									</article>
								</div>
								@endforeach
								@else
									<div class="e-pick-alert">
			                            <div class="alert alert-info text-center">
			                                {{ __("There are no editor's picked posts at the moment check later!") }}
			                            </div>                   
			                        </div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection