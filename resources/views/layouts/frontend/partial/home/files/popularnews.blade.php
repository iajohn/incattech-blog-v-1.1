<!-- Start Popular News feed Area -->
<section class="popular-news-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2 class="heading title">Latest News Feed</h2>
				</div>
			</div>
		</div>

		<div class="row">
			@if($latest_top->count() > 0 )
				@foreach($latest_top as $posts)
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-post single-int mb-40">
							<div class="thumb">
								<div class="relative">
									<img class="f-img img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg) }}" alt="">
								</div>
							</div>
							<div class="">
								<div class="bottom mt-10 d-flex justify-content-between align-items-center flex-wrap">
									<div>
										@foreach($posts->categories as $cat)
											<a href="#" class="primary-btn">{{ $cat->name }}</a>
										@endforeach
										<a href="#"><span>September 14, 2018</span></a>
									</div>
								</div>
								<a href="#">
									<h4>Facts Why Inkjet Printing Is Very
										Appealing Compared</h4>
								</a>
							</div>
						</div>

						<div class="single-post single-int mb-40">
							<div class="thumb">
								<div class="relative">
									<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/popular-news/p2.jpg') }}" alt="">
								</div>
							</div>
							<div class="">
								<div class="bottom mt-10 d-flex justify-content-between align-items-center flex-wrap">
									<div>
										<a href="#" class="primary-btn">gadgets</a>
										<a href="#"><span>September 14, 2018</span></a>
									</div>
								</div>
								<a href="#">
									<h4>Facts Why Inkjet Printing Is Very
										Appealing Compared</h4>
								</a>
							</div>
						</div>
					</div>
				@endforeach
				@else
			@endif

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-post single-int mb-40">
					<div class="thumb">
						<div class="relative">
							<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/popular-news/p3.jpg') }}" alt="">
						</div>
					</div>
					<div class="">
						<div class="bottom mt-10">
							<div>
								<a href="#" class="primary-btn">gadgets</a>
								<a href="#"><span>September 14, 2018</span></a>
							</div>
						</div>
						<a href="#">
							<h4 class="mt-15">Facts Why Inkjet Printing Is Very
								Appealing Compared</h4>
						</a>
					</div>
				</div>
				<div class="single-post single-int mb-40">
					<div class="thumb">
						<div class="relative">
							<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/popular-news/p4.jpg') }}" alt="">
						</div>
					</div>
					<div class="">
						<div class="bottom mt-10">
							<div>
								<a href="#" class="primary-btn">gadgets</a>
								<a href="#"><span>September 14, 2018</span></a>
							</div>
						</div>
						<a href="#">
							<h4>Facts Why Inkjet Printing Is Very
								Appealing Compared</h4>
						</a>
					</div>
				</div>
			</div>

			@if($latest_top->count() > 0 )
				@foreach($latest_top as $posts)
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="single-post single-int mb-40">
							<div class="thumb">
								<div class="relative">
									<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/popular-news/p-vdo.jpg') }}" alt="">
									<a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM">
										<img src="img/play-icon.png" class="vdo-btn" alt="">
									</a>
								</div>
							</div>
							<div class="">
								<div class="bottom mt-10 d-flex justify-content-between align-items-center flex-wrap">
									<div>
										<a href="#" class="primary-btn">gadgets</a>
										<a href="#"><span>September 14, 2018</span></a>
									</div>
									<div class="meta">
										<span class="lnr lnr-bubble"></span> 04
									</div>
								</div>
								<a href="#">
									<h4 class="mt-15">Dealing With Technical Support with Printing Is Very
										Appealing Comp 10 Useful Tips</h4>
								</a>
								<p>
									It won’t be a bigger problem to find one video game lover in your neighbor. Since the introduction of Virtual
									Game, it has beenachieving great heights so far as its popularity and technological advancement are
									concerned.
								</p>
							</div>
						</div>
					</div>
				@endforeach
				@else
			@endif
		</div>
	</div>
</section>
<!-- End Popular News feed Area -->