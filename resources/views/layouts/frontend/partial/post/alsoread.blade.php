<section class="int-news-area section-gap-top mb-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2 class="heading">Also Read</h2>
							<div id="nav-carousel-2" class="custom-owl-nav pull-right"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div id="owl-carousel-2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 owl-carousel owl-theme">
						
							@foreach($also_read as $posts)
								<div class="single-post single-int post-body lsm">
									<div class="thumb small">
										<div class="relative">
											<a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
												<img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg ) }}" alt="">
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

									<div class="details e-pick">
										<a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
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
							
					</div>
				</div>
			</div>
		</div>
	</div>
</section>