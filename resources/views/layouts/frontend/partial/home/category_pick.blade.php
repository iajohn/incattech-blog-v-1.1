<div class="col-lg-3 col-md-12">
	<div class="row">
		@foreach($categories_pick  as $cat)
			<div class="col-lg-12 col-md-4 col-sm-6">
				<div class="single-post mb-03 c-l">
					<div class="thumb">
						<!-- <a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" target="_blank"> -->
							<div class="relative">
									<img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/category/slider/'.$cat->featuredImg) }}" 
									     alt="{{ $cat->name }}" title="{{ $cat->name }}">
								<div class="overlay overlay-bg"></div>
							</div>
						<!-- </a> -->
					</div>
					<div class="details">
						<div class="bottom d-flex justify-content-between align-items-center flex-wrap">
							<div class="text-center">
								<a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" target="_blank" class="primary-btn">
									<span class="category" title="{{ $cat->name }}">{{ $cat->name }}</span>
								</a>
							</div>
							<!-- <div class="meta">
								<span class="lnr lnr-bubble"></span> 04
							</div> -->
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>