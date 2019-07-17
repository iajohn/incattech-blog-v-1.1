<div class="col-lg-6 col-md-8 owl-carousel active-banner owl-theme center-owl-nav" id="active-banner">
	@if($randomPosts->count() > 0)
		@foreach($randomPosts as $Posts)
			<div class="single-post m-c">
				<div class="thumb">
					<div class="relative">
						@if($Posts->featuredImg)
                            <img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$Posts->featuredImg) }}" 
							 alt="{{ $Posts->title }}">
                        @else
                            <div class="feature-img-art">
                                <div class="feature-img-article-ti"> {{ substr($Posts->title, 0) }} </div>
                            </div>
                        @endif
						
						<div class="overlay overlay-bg"></div>
					</div>
				</div>
				<div class="details">
					<div class="bottom d-flex justify-content-start align-items-center flex-wrap">
						<div class="P-caty">
							<span class="fa fa-folder ml-0 mr-0 article-type" style="color: #fff;"></span>
							<span class="ml-0">
								@foreach($Posts->categories as $cat)
									<a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1" title="{{ $cat->name }}">
										{{ $cat->name }}
									</a> 
								@endforeach
							</span>							
							<a href=""><span>{{ $Posts->created_at->toFormattedDateString() }}</span></a>
						</div>
						<div class="meta">

                            @guest
                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                    closeButton: true,
                                    progressBar: true,
                                })">
                                	<span class="lnr lnr-heart"></span> {{ $Posts->favorite_to_users->count() }}
                                </a>
                            @else
                                <a 	href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $Posts->id }}').submit();"
                                   	class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$Posts->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                   	<span class="lnr lnr-heart"></span> {{ $Posts->favorite_to_users->count() }}
                                </a>

                                <form id="favorite-form-{{ $Posts->id }}" method="POST" action="{{ route('post.favorite',$Posts->id) }}" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
						</div>
					</div>
					<a href="{{ route('post.details', [ 'slug' => $Posts->slug ]) }}" title="{{ $Posts->title }}">
						<h4 class="">
							{{ $Posts->title }}
						</h4>
					</a>
					<!-- <a href="#" class="primary-btn fill mt-30">read more</a> -->
				</div>
			</div>
		@endforeach
		@else
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
						<a href="{{ route('about') }}">
							<h4 class="lg-font">
								{!! str_limit($setting->about_body, $limit = 82, $end = ' '.'...') !!} </p>
							</h4>
						</a>
					</div>
				</div>
			@endforeach
    @endif
</div>