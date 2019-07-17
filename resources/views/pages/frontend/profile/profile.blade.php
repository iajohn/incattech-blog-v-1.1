@extends('layouts.frontend.front_app')

@section('title')
{{ $author->username }}
@stop

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/profile/profile.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/frontend/themes/css/custom.css') }}" rel="stylesheet"> -->
    <style type="text/css">
	    .block-body span.name {
		    margin-left: 0px;
		    padding: 10px 16px;
		    background: #fff;
		    border-radius: 50%;
		    text-transform: uppercase;
		    font-size: 30px;
		    border: 1px solid;
		    line-height: 55px;
		}

		.skin-default span.name {
		    margin-left: 0px; 
		    padding: 10px 15px;
		    background: #ccc;
		    border-radius: 50%;
		    margin-right: 10px;
		}

		.skin-dark span.name {
		    margin-left: 0px; 
		    padding: 10px 15px;
		    background: #2e2e2e;
		    border-radius: 50%;
		    margin-right: 10px;
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
                            	{{ $author->username }}
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
				<div class="col-md-12 col-sm-12 col-xs-12 main-page">
					<section class="">
						<aside>
							<div class="aside-body">
								<div class="featured-author">
									<div class="featured-author-inner">
										<div class="featured-author-cover" style="background-image: url('');">
											<div class="featured-author-center">
												<figure class="featured-author-picture">
													@if($author->profile->profile_pics)
						                            	<a class="" href="{{ route('author.profile',$author->username) }}">
			                                                <img src="{{ asset($author->profile->profile_pics) }}" alt="{{ $author->username }}" class="img-circle">
			                                            </a>
						                            @else
						                                <span class="name" style="text-transform:uppercase;"> {{ substr($author->username, 0, 1) }} </span>
						                            @endif
													
												</figure>

												<div class="featured-author-info">									           
													<h2 class="name">{{ $author->firstname }} {{ $author->lastname }}</h2>
													<div class="desc">@ {{ $author->username }}</div>
													<strong class="bio-content">Author Since: {{ $author->created_at->toFormattedDateString() }}</strong><br>
													<!-- <div class="featured-author-quote ">
														<p class="job mb-15">
															@if($author->profile->about)
										                        {{ $author->profile->about }}
										                        You can reach me on social media by following the links below.
										                        @else
										                            I am 
										                            @if($author->profile->occupation )
										                                {{ $author->profile->occupation }} 
										                                @else 
										                                lover of fashion and technology, 
										                            @endif 
										                            
										                            @if($settings)
										                                at {{ $settings->find(5)->val }},
										                                @else 
										                                and I'm skilled at writing blog contents and any forms of articles.
										                            @endif 

										                            I'm skilled at writing blog contents and any forms of articles. 
										                            You can reach me on social media by following the links below. 
										                    @endif
														</p>
														<br></br>
														<br></br>
													</div> -->
												</div>
											</div>
										</div>

										<div class="featured-author-body ml-0 mr-0">
											<div class="featured-author-count">
												<ul class="nav nav-tabs nav-justified" role="tablist">
													<li class="nav-item item">
														<a class="nav-link active" href="#posts" data-toggle="tab">
															<i class="ion-ios-chatboxes-outline"></i> 
															<div class="name">
																@guest
								                                    Posts By {{ $author->username }} 
								                                @else
								                                    @if(Auth::user()->username == $author->username) 
																		Posts By You
																		@else 
																			Posts By {{ $author->username }} 
																	@endif
								                                @endguest
															</div>
															<div class="value">{{ $author->posts->count() }}</div>
														</a>
													</li>
													
													<li class="nav-item item">
														<a class="nav-link" href="#fav-post" data-toggle="tab">
															<i class="fa fa-heart"></i>
															<div class="name">
																	
																@guest
								                                    {{ $author->username }}'s Heart Article List 
								                                @else
								                                    @if(Auth::user()->username == $author->username) 
																		Your Heart Lists
																			@else 
																				{{ $author->username }}'s Heart List
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
								                                    {{ $author->username }}'s Heart Video List 
								                                @else
								                                    @if(Auth::user()->username == $author->username) 
																		Your Heart Lists
																			@else 
																				{{ $author->username }}'s Videos Heart List
																	@endif
								                                @endguest
															</div>
															<div class="value">{{ $fav_posts->count() }}</div>
														</a>
													</li>
												</ul>
											</div>
											
											<div class="tab-content">
												<div class="tab-pane active" id="posts">
													<div class="row">
														@if($posts->count() > 0)
															@foreach($posts as $post)
																<div class="col-lg-4 col-md-6 col-sm-12">
																	<div class="single-post single-int lsm mb-40 post-body">
																		<!-- <div class="col-lg-12 col-md-12 col-sm-12 text-left">
										                                    <div class="d-flex justify-content-start a-avt">
										                                        <div class="img-cont mr-15">
										                                            <a class="" href="{{ route('author.profile',$post->user->username) }}">
										                                                <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}" class="img-fluid img-circle">
										                                            </a>
										                                        </div>
										                                        <div class="name-date pt-2">
										                                        	<small>posted by</small>
										                                            <a class="name" href="{{ route('author.profile',$post->user->username) }}">
										                                                <span class="text-white">
										                                                	{{ $post->user->username }}
										                                                </span>
										                                            </a>
										                                            
										                                            <small> on {{ $post->created_at->toFormattedDateString() }}</small>
										                                        </div>
										                                    </div>
										                                </div> -->
																		
																		<div class="thumb small">
																			<div class="relative">
																				<img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$post->featuredImg) }}" alt="">
																				<div class="overlay overlay-bg"></div>
																			</div>
																		</div>

																		<ul class="">
														        			<li class="date-info-type l-bottom">
														        				<small>
														        					{{ $post->created_at->toFormattedDateString() }} 
														        				</small>
														        			</li>
														        		</ul>

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
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="e-pick-alert">
															            <div class="alert alert-info text-center">
															                {{ __("Sorry")}} {{ $author->username }} {{__("does not have published posts at the moment check later!") }}
															            </div>                   
															        </div>
															    </div>
														@endif
													</div>
												</div>
												
												<div class="tab-pane fade" id="fav-post">
													<div class="row">
														@if($fav_posts->count() > 0)
															@foreach($fav_posts as $post)
																<div class="col-lg-4 col-md-6 col-sm-12">
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
													                                <span class="name" style="text-transform:uppercase;"> {{ substr($post->user->username, 0, 1) }} </span>
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
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="e-pick-alert">
															            <div class="alert alert-info text-center">
															                {{ __("Sorry")}} {{ $author->username }} {{__("does not have favorite posts at the moment check later!") }}
															            </div>                   
															        </div>
															    </div>
														@endif
													</div>
												</div>

												<div class="tab-pane fade" id="fav-video">
													<div class="row">
														@if($fav_posts->count() > 0)
															@foreach($fav_posts as $post)
																<div class="col-lg-4 col-md-6 col-sm-12">
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
													                                <span class="name" style="text-transform:uppercase;"> {{ substr($post->user->username, 0, 1) }} </span>
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
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="e-pick-alert">
															            <div class="alert alert-info text-center">
															                {{ __("Sorry")}} {{ $author->username }} {{__("does not have favorite posts at the moment check later!") }}
															            </div>                   
															        </div>
															    </div>
														@endif
													</div>
												</div>
											</div>

											<div class="block">
												<h2 class="block-title">Other Authors</h2>
												<div class="block-body">
													@if ($authors)
														@foreach ($authors as $user)
															@if($user->profile->profile_pics)
								                            	<ul class="item-list-round" data-magnific="gallery">
																	<li>
																		<a class="" href="{{ route('author.profile',$user->username) }}" 
																		   style="background-image: url('{{ asset($user->profile->profile_pics) }}');">
							                                            </a>
																	</li>
																</ul>
								                            @else
								                            	<ul class="item-list-round" data-magnific="gallery">
																	<li>
																		<a class="" href="{{ route('author.profile',$user->username) }}" 
																		   style="background-image: url('');">
								                                		<span class="name"> {{ substr($user->username, 0, 1) }} </span>
								                                		</a>
								                                  	</li>
																</ul>
								                            @endif
														@endforeach
													@endif
												</div>
											</div>

											<div class="featured-author-footer">
												<div class="row">
													<div class="md-6">
														<div class="bio-content ml-15">
														    <div class="middle-part d-flex mt-3">
											                    <div class="conn ml-3 mr-3">Social Media Link</div>
											                    <span class="lnr lnr-arrow-down text-white"></span>
											                </div>

											                <div class="bottom-part">
											                    <div class="col-lg-12 col-md-12 col-sm-6 social ml-3">
											                        <a href="{{ $author->profile->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
											                        <a href="{{ $author->profile->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
											                        <a href="{{ $author->profile->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
											                        <a href="{{ $author->profile->youtube }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
											                        <a href="{{ $author->profile->whatsapp }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
											                        <!-- <a href="#"><i class="fa fa-rss"></i></a> -->
											                    </div>
											                </div>
											            </div>
											        </div>

											        <div class="col-md-6 ml-3 mr-3 mt-4">
										            	<a class="btn btn-default" href="{{ route('all_author') }}">See All Authors</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</aside>

						

						{{--{{ $posts->links() }}--}}
					</section>
					<!-- End Technology News Area -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Main Area -->

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection