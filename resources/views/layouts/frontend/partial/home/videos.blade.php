<!--Start Exclusive Videos Area -->
<section class="excl-vdo-area section-gap-top-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2 class="heading title">Featured Tv</h2>
				</div>
			</div>
		</div>

		<div class="row">
			@if($featured->isEmpty())
                <div data-abide-error="" class="alert callout" style="display: block;">
                    <p><i class="fa fa-exclamation-triangle"></i> No Featured Movies</p>
                </div>
            @else
				<div class="col-lg-12 owl-carousel" id="videos">
					<div class="single-post single-int mb-40">
						<div class="thumb">
							<div class="relative">
								<?php $i=0 ?>
	                            @foreach($featured as $feat)
	                                <div class="image {{ $i }}">
	                                    <img class="f-img img-fluid mx-auto" src="{{ asset($feat->video_cover_location) }}" alt="{{ $feat->video_title }}">
	                                    <a href="{{ route('tv.details', $feat->video_slug) }}" class="hover-posts" target="_blank">
	                                        <span><i class="fa fa-play"></i>Watch Video</span>
	                                    </a>

		                                <!-- <img class="f-img img-fluid mx-auto" src="{{ asset($feat->video_cover_location) }}" alt="">
										<a target="_blank" class="play-btn" href="{{ route('tv.details', $feat->video_slug) }}">
											<img target="_blank" src="{{ asset('assets/frontend/themes/img/play-icon.png') }}" class="vdo-btn" alt="">
										</a> -->
	                                </div>
	                                <?php $i++ ?>
	                            @endforeach
							</div>
						</div>
						<div class="">
							<div class="bottom mt-10 d-flex justify-content-between align-items-center flex-wrap">
								<div class="caty">
									<span class="fa fa-folder ml-0 mr-0 article-type"></span>
									<span class="ml-2">
										@foreach($feat->channels as $cat)
											<a href="{{ url('/tv/channel', [ 'slug' => $cat->slug ]) }}" class="pl-1 pr-1" title="{{ $cat->name }}">
												{{ $cat->name }}
											</a> 
										@endforeach
									</span>
									
									<h6>
                                    	<a href="{{ url('tv', $feat->video_slug) }}" target="_blank" title="{{ $feat->video_title }}">
                                            {{ str_limit($feat->video_title, 45) }}
                                        </a>
                                    </h6>
								</div>
								<div class="">
									<a class="ml-0 pull-right">
										<span>
											<span class="lnr lnr-clock"></span>{{ $feat->created_at->toFormattedDateString() }} 
										</span>
									</a>
									<span class="lnr lnr-eye"></span> {!! kilomega($feat->video_views) !!}
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</section>
<!-- End Exclusive Videos Area