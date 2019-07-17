<section class="int-news-area">
	<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2 class="heading title">{{__('Latest News')}}</h2>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 latest">
					<div class="row">
						@if($latest_first)
							@foreach($latest_first as $posts)
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="single-post single-int post-body lsm mb-40">
										<div class="thumb medium">
											<div class="relative">
												@if($posts->featuredImg)
						                            <a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
														<img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg ) }}" alt="">
													</a>
						                        @else
						                            <div class="feature-img-art">
						                                <div class="feature-img-article-ti"> {{ substr($posts->title, 0) }} </div>
						                            </div>
						                        @endif
												
												<div class="overlay overlay-bg"></div>
											</div>	
										</div>

										<ul class="">
						        			<li class="date-info-type l-top">
						        				<small>
						        					{{ $posts->created_at->toFormattedDateString() }} 
						        				</small>
						        			</li>
						        		</ul>

										<div class="details e-pick">
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
															<a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="pl-1 pr-1" title="{{ $cat->name }}">
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
							                {{ __("There are no posts at the moment check later!") }}
							            </div>                   
							        </div>
							    </div>
						@endif
					</div>
				</div>

				<div class="col-lg-12 col-md-12">
					<div class="row">
						@if($latest_bottom)
							@foreach($latest_bottom as $posts)
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="single-post single-int post-body lsm mb-40">
										<div class="thumb small">
											<div class="relative">
												@if($posts->featuredImg)
						                            <a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
														<img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg ) }}" 
														alt="{{ $posts->title }}">
													</a>
						                        @else
						                            <div class="feature-img-art">
						                                <div class="feature-img-article-ti"> {{ substr($posts->title, 0) }} </div>
						                            </div>
						                        @endif
												
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
															<a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="pl-1 pr-1" title="{{ $cat->name }}">
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
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="e-pick-alert">
						            <div class="alert alert-info text-center">
						                {{ __("There are no posts at the moment check later!") }}
						            </div>                   
						        </div>
						    </div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>