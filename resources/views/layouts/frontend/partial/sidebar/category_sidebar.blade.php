<div class="col-md-4 col-sm-4 sidebar" id="sidebar">
	<aside>
		<div class="aside-body">
			<figure class="ads">
				<div class="ad-widget-wrap">
					<img src="{{ asset('assets/frontend/themes/img/ads/ad-600-550.png') }}" style="width:100%;" alt="">
				</div>
				<figcaption>Advertisement</figcaption>
			</figure>
		</div>
	</aside>

	<aside>
		<div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <!-- <h2 class="heading title">{{__('Top Posts')}}</h2> -->
                </div>
            </div>
        </div>

		<div class="aside-body">
			@if($mostRead->count() > 0)
		        @foreach($mostRead as $posts)
		            <div class="single-post single-int post-body lsm mb-40">
							<div class="thumb small">
								<div class="relative">
									<a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
										<img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg ) }}" 
										     alt="{{ $posts->title }}" title="{{ $posts->title }}">
									</a>
									<div class="overlay overlay-bg"></div>
								</div>	
							</div>

							<ul class="">
			        			<li class="date-info-type l-bottom">
			        				<small>
			        					{{ $posts->created_at->toFormattedDateString() }} 
			        				</small>
			        			</li>
			        		</ul>

							<div class="details">
								<a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}" title="{{ $posts->title }}">
									<h4>{{ $posts->title }}</h4>
								</a>
							</div>

							<div class="">
								<div class="bottom pt-20 d-flex justify-content-between align-items-center flex-wrap">
									<div class="caty">
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
							</div>
						</div>
				@endforeach
				@else
					<div class="row">
		                <div class="e-pick-alert col-md-12">
		                    <div class="alert alert-info text-center">
		                        <p>{{ __('Sorry, there are no trending posts at the moment!') }}</p>
		                    </div>                   
	                	</div>
	                </div>
	        @endif
			
			<div class="line"></div>

			@foreach($lessMostRead as $lmr)
	        	<div class="single-post post-body">
			        <article class="article-mini article mt-4">
						<div class="inner">
							<figure class="article-img">
								<a href="{{ route('post.details', $lmr->slug) }}" title="{{ $lmr->title }}">
				                    <img src="{{ asset('assets/uploads/post/thumb/'.$lmr->featuredImg) }}" alt="{{ $lmr->title }}">
				                </a>
							</figure>

							<div class="padding">
								<h1 title="{{ $lmr->title }}">
									<a href="{{ route('post.details', $lmr->slug ) }}" title="{{ $lmr->title }}">
									    {!! str_limit($lmr->title, $limit = 40, $end = ' '.'...') !!} </p>
									</a>
								</h1>
							</div>
						</div>
					</article>
				</div>
		    @endforeach					       
		</div>
	</aside>

	<aside>
		<div class="aside-body">
			<figure class="ads">
				<div class="ad-widget-wrap">
					<img src="{{ asset('assets/frontend/themes/img/ads/ad-300-600.jpg') }}" style="width:100%;" alt="">
				</div>
				<figcaption>Advertisement</figcaption>
			</figure>
		</div>
	</aside>

	<!-- Start Twitter Area -->
	@include('layouts.frontend.partial.sidebar.tweet')
	<!-- End Twitter Area -->
</div>
