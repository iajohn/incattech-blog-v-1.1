<!-- SECTION -->
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title heading">{{__('Trendings')}}</h2>
					<ul class="nav nav-tabs pull-right">
						<li class="nav-item">
					    	<a class="nav-link active" data-toggle="tab" href="#tab-all">
					    		<span class=" Stat-statLabel "> {{ __('All') }} </span>
					    	</a>
						</li>

						@foreach($categories as $cat)
	                        <li id="navbar" class="scrollmenu text-center {{ Request::is('/category/{slug}') ? 'nav-item menu-active' : '' }}">
							    <a class="nav-link" data-toggle="tab" href="#tab-{{ $cat->slug }}">
							    	<span class=" Stat-statLabel "> {{ $cat->name }} </span>
							    </a>
	                        </li>
						@endforeach
					</ul>
				</div>

				<div class="tab-content">
					<div class="tab-pane active" id="tab-all">
						<div class="row clearfix">
							@if($trendng_posts->count() > 0 )
								@foreach($trendng_posts as $posts)
									<div class="col-lg-6 col-md-6 col-sm-12 single-post post-body">
										<div class="">
											<div class="thumb medium">
												<div class="relative">
													<a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}">
														<img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg ) }}" alt="">
													</a>
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
						                <div class="">
						                    <div class="e-pick-alert">
						                        <div class="alert alert-info text-center">
						                            {{ __("There are no Trending posts in at the moment check later!") }}
						                        </div>                   
						                    </div>
						                </div>
						            </div>
							@endif
						</div>
					</div>

					<!-- Start Categories Area -->
						@include('layouts.frontend.partial.home.trendings.tab_1')

						@include('layouts.frontend.partial.home.trendings.tab_2')

						@include('layouts.frontend.partial.home.trendings.tab_3')
						
						@include('layouts.frontend.partial.home.trendings.tab_4')

						@include('layouts.frontend.partial.home.trendings.tab_5')

						@include('layouts.frontend.partial.home.trendings.tab_6')

						@include('layouts.frontend.partial.home.trendings.tab_7')
						
						@include('layouts.frontend.partial.home.trendings.tab_8')
					<!-- End Categories Area -->
				</div>
			</div>
		</div>
	</div>
</div>