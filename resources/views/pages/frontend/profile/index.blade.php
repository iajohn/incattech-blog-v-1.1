@extends('layouts.frontend.front_app')

@section('title', 'Authors')


@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/profile/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/themes/css/placeholder.css') }}" rel="stylesheet">
    <style type="text/css">
    	.profile .image span.name {
		    margin: 0px;
		    /*padding: 30px 27px;*/
		    padding: 26px 30px;
		    background: #fff;
		    border-radius: 50%;
		    line-height: 80px;
		    text-transform: uppercase;
		    font-size: 30px;
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
                            	All Authors ( {{$authors->count()}} )
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
						<div class="row">
							@if($authors->count() > 0)
								@foreach($authors as $author)
									<div class=" col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
										<div class="center">
											<div class="profile">
												<div class="image">
													<div class="circle-1"></div>
													<div class="circle-2"></div>
													@if($author->profile->profile_pics)
						                            	<a class="short-avatar" href="{{ route('author.profile',$author->username) }}" 
										                	data-href="{{ route('author.profile',$author->username) }}">
										                    <img src="{{ asset($author->profile->profile_pics) }}" width="80px" height="80px" alt="{{ $author->username }}">
										                </a>
						                            @else
						                                <span class="name"> {{ substr($author->username, 0, 1) }} </span>
						                            @endif
												</div>
												
												<div class="name">
													<a class="short-name" href="{{ route('author.profile',$author->username) }}">
									                    <strong>{{ $author->firstname }} {{ $author->lastname }}</strong>
									                </a>
												</div>
												<span class="UserUsername">
									                <a class="short-name" href="{{ route('author.profile',$author->username) }}">
									                   {{ ' @' . $author->username }}
									                </a>   
									            </span>
											</div>

											<div class="stats">
												<a class="" href="{{ route('author.profile',$author->username) }}" 
							                       data-push="tooltip" data-placement="bottom" data-title=" ">
													<div class="box">
							                            <span class="value"> {{ $author->posts->count() }} </span>
							                            <span class="parameter" id="friends-count"> {{ __('Posts') }} </span>
													</div>
							                    </a>

							                    <a class="" href="{{ route('author.profile',$author->username) }}" 
							                       data-push="tooltip" data-placement="bottom" data-title="">
													<div class="box">
								                        <span class="value"> {{ $author->favorite_posts->count() }} </span>
								                        <span class="parameter"> {{ __('Heart') }} </span>
							                    	</div>
							                    </a>

							                    <div class="drdown">
													<div class="box drbtn">
														<span class="value" id="friends-count">
															<span class="lnr lnr-phone"></span>
														</span>
														<span class="parameter">
															{{ __('connect') }}
														</span>
													
														<div class="drdown-content">
														    <a href="{{ $author->profile->facebook }}" target="_blank" class="drdown-item list-group-item">
																<i class="fa fa-facebook"></i>
															</a>

														    <a href="{{ $author->profile->facebook }}" target="_blank" class="drdown-item list-group-item">
																<i class="fa fa-instagram"></i>
															</a>

														    <a href="{{ $author->profile->twitter }}" target="_blank" class="drdown-item list-group-item">
																<i class="fa fa-twitter"></i>
															</a>

															<a href="{{ $author->profile->youtube }}" target="_blank" class="drdown-item list-group-item">
																<i class="fa fa-youtube-play"></i>
															</a>

															<a href="{{ $author->profile->whatsapp }}" target="_blank" class="drdown-item list-group-item">
																<i class="fa fa-whatsapp"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>	
								@endforeach
								@else

							@endif
						</div>
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