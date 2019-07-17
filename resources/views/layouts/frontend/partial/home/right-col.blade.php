<div class="col-lg-3 col-md-4">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-6">
			<div class="single-post mb-03 c-r">
				<div class="thumb">
					<div class="relative">
						<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/ads/ad-600-550.png') }}" alt="">
						<div class="overlay overlay-bg"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-6">
			<div class="single-post c-r _nl">
				<div class="thumb">
					<div class="relative">
						<img class="f-img img-fluid mx-auto" src="{{ asset('assets/frontend/themes/img/banner/br1.jpg') }}" alt="">
						<div class="overlay overlay-bg"></div>
					</div>
				</div>
				<div class="details">
					<div class="top-part justify-content-between">
						<div>
							<h4 class="mt-0">Subscribe to Newslatter</h4>
						</div>

						<form method="post" action="{{ route('subscriber.store') }}">
					        @csrf

					        <input class="form-control input" name="email" type="email" placeholder="Enter Your Email">
					        <button class="btn btn-lg primary-btn input-btn pull-right mt-2" type="submit">
					        	<span class="lnr lnr-envelope"></span>
					        </button>
					    </form>
					</div>
					
					<div class="middle-part d-flex c-w-u">
						<!-- <div class="conn mr-3">Social Media Link</div>
						<span class="lnr lnr-arrow-down text-white"></span> -->
						<div class="drdown">
							<div class="box drbtn">
								<span class="parameter">
									{{ __('Social Connect') }}
								</span>
								<span class="value" id="friends-count">
									<span class="lnr lnr-arrow-up text-white"></span>
								</span>
								@foreach($company as $company)
									<div class="drdown-content">
									    <a href="{{ $company->facebook }}" target="_blank" class="drdown-item list-group-item">
											<i class="fa fa-facebook"></i>
										</a>

									    <a href="{{ $company->facebook }}" target="_blank" class="drdown-item list-group-item">
											<i class="fa fa-instagram"></i>
										</a>

									    <a href="{{ $company->twitter }}" target="_blank" class="drdown-item list-group-item">
											<i class="fa fa-twitter"></i>
										</a>

										<a href="{{ $company->youtube }}" target="_blank" class="drdown-item list-group-item">
											<i class="fa fa-youtube-play"></i>
										</a>

										<a href="{{ $company->whatsapp }}" target="_blank" class="drdown-item list-group-item">
											<i class="fa fa-whatsapp"></i>
										</a>
									</div>
								@endforeach
							</div>
						</div>
					</div>

					<div class="bottom-part hidden-md">
						<!-- <div class="col-lg-12 col-md-12 col-sm-6 social">
							<a href="{{ $settings->find(9)->val }}" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="{{ $settings->find(10)->val }}" target="_blank"><i class="fa fa-instagram"></i></a>
							<a href="{{ $settings->find(11)->val }}" target="_blank"><i class="fa fa-twitter"></i></a>
							<a href="{{ $settings->find(12)->val }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
							<a href="{{ $settings->find(13)->val }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>