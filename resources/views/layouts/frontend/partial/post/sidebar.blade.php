<div class="col-md-4 col-sm-4 sidebar" id="sidebar">
	<aside>
		<div class="aside-body">
			<figure class="ads">
				<img src="{{ asset('assets/frontend/themes/img/ad-600x550.png') }}">
				<figcaption>Advertisement</figcaption>
			</figure>
		</div>
	</aside>

	<aside>
		<ul class="nav nav-tabs nav-justified" role="tablist">
			<li class="active">
				<a href="#for-you" aria-controls="for-you" role="tab" data-toggle="tab">
					<!-- <i class="ion-android-star-outline"></i>  -->
					{{ __('Recent Post') }}
				</a>
			</li>
			<li>
				<a href="#top-post" aria-controls="top-post" role="tab" data-toggle="tab">
					<!-- <i class="ion-ios-chatboxes-outline"></i>  -->
					{{ __('Top Post') }}
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="for-you">
	            @if($recentPost->count() > 0)
		            @foreach($recentPost as $rp)			   
						<article class="article thumb-article">
                        	<div class="article-img">
                        		<a href="{{ route('post.index', [ 'slug' => $rp->slug ]) }}">
									<img src="{{ $rp->featured }}" alt="{{ $rp->title }}" title="{{ $rp->title }}">
								</a>
                        	</div>
                        	
                        	<div class="article-body">
                        		<ul class="article-info pl-0 hidden">
                        			<li class="article-category">
                        			    <img src="{{ asset($rp->user->profile->profile_pics) }}" style="width: 33px;height: 33px;border: 1px solid #fff;" 
                        			         class="mr-3 img-responsive img-circle pull-left">
                    				    <a href="" title="{{ $rp->user->name }}">
    			                            {{ $rp->user->name }}
    			                        </a>
                        			</li>
                        		</ul>
                        		<h3 class="article-title" title="{{ $rp->title }}">
                        		     <a href="{{ route('post.index', [ 'slug' => $rp->slug ]) }}" title="{{ $rp->title }}">
                        		         {!! str_limit($rp->title, $limit = 40, $end = ' '.'...') !!} </p>
                        		     </a>
                        		</h3>
                        		<ul class="article-meta pl-0">
                        			<li><i class="ion-clock"></i> {{ $rp->created_at->toFormattedDateString() }} </li>
                        			<li>
    			                         @foreach($rp->categories as $category)
                                            <a href="{{ route('category.posts',$category->slug) }}" class="primary-btn mr-10 mb-3">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
    			                    </li>
                        		</ul>
                        	</div>
                        </article>
			        @endforeach
			    @else
					<div class="row">
		                <div class="col-md-12">
		                    <div class="alert alert-info text-center">
		                        <p>{{ __('There are no posts picked by our editors at the moment check later!') }}</p>
		                    </div>                   
	                	</div>
	                </div>
	            @endif

		   		<div class="line"></div>

		        @foreach($moreRecent as $mr)
			        <article class="article-mini article">
						<div class="inner">
							<figure class="article-img">
								<a href="{{ route('post.index', [ 'slug' => $mr->slug ]) }}" title="{{ $mr->title }}">
				                    <img src="{{ $mr->featured }}" alt="{{ $mr->title }}" title="{{ $mr->title }}">
				                </a>
							</figure>

							<div class="padding">
								<h1 title="{{ $mr->title }}">
									<a href="{{ route('post.index', [ 'slug' => $mr->slug ]) }}" title="{{ $mr->title }}">
									    {!! str_limit($mr->title, $limit = 40, $end = ' '.'...') !!} </p>
									</a>
								</h1>
								<div class="detail">
									<div class="time mr-2">{{ $mr->created_at->toFormattedDateString() }}</div>
									<div class="category">
										@foreach($mr->categories as $category)
                                            <a href="{{ route('category.posts',$category->slug) }}" class="primary-btn mr-10 mb-3">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</article>
			    @endforeach
			</div>
			
			<div class="tab-pane comments" id="top-post">
				@foreach($mostRead as $mr)
					<article class="article thumb-article">
                    	<div class="article-img">
                    		<a href="{{ route('post.index', [ 'slug' => $mr->slug ]) }}">
								<img src="{{ $mr->featured }}" alt="{{ $mr->title }}" title="{{ $mr->title }}">
							</a>
                    	</div>
                    	
                    	<div class="article-body">
                    		<ul class="article-info pl-0 hidden">
                    			<li class="article-category">
                    			    <img src="{{ asset($mr->user->profile->profile_pics) }}" style="width: 33px;height: 33px;border: 1px solid #fff;" 
                    			         class="mr-3 img-responsive img-circle pull-left">
                				    <a href="" title="{{ $mr->user->name }}">
			                            {{ $mr->user->name }}
			                        </a>
                    			</li>
                    		</ul>
                    		<h3 class="article-title">
                    		     <a href="{{ route('post.index', [ 'slug' => $mr->slug ]) }}" title="{{ $mr->title }}">
                    		         {!! str_limit($mr->title, $limit = 40, $end = ' '.'...') !!} </p>
                    		     </a>
                    		</h3>
                    		<ul class="article-meta pl-0">
                    			<li><i class="ion-clock"></i> {{ $mr->created_at->toFormattedDateString() }} </li>
                    			<li>
			                        @foreach($mr->categories as $category)
                                        <a href="{{ route('category.posts',$category->slug) }}" class="primary-btn mr-10 mb-3">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
			                    </li>
                    		</ul>
                    	</div>
                    </article>
		        @endforeach

		   		<div class="line"></div>

		        @foreach($lessMostRead as $lmr)
			        <article class="article-mini article">
						<div class="inner">
							<figure class="article-img">
								<a href="{{ route('post.index', [ 'slug' => $lmr->slug ]) }}" title="{{ $lmr->title }}">
				                    <img src="{{ $lmr->featured }}" alt="{{ $lmr->title }}" title="{{ $lmr->title }}">
				                </a>
							</figure>

							<div class="padding">
								<h1 title="{{ $lmr->title }}">
									<a href="{{ route('post.index', [ 'slug' => $lmr->slug ]) }}" title="{{ $lmr->title }}">
									    {!! str_limit($lmr->title, $limit = 40, $end = ' '.'...') !!} </p>
									</a>
								</h1>
								<div class="detail">
									<div class="time mr-2">{{ $lmr->created_at->toFormattedDateString() }}</div>
									<div class="category">
				                        @foreach($lmr->categories as $category)
                                            <a href="{{ route('category.posts',$category->slug) }}" class="primary-btn mr-10 mb-3">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</article>
			    @endforeach
			</div>
		</div>
	</aside>


</div>