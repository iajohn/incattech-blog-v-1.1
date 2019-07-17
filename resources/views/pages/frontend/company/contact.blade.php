@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $title,
        'type'          => 'articles',
        'url'           => route('contact'),
        'image'         => asset('assets/frontend/themes/img/preview_dark.png'),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title',$title)

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
    	.single-post.post-body {
		    border: 1px solid #5556;
		}

		.single-post.post-body:hover {
            box-shadow: 0px 5px 15px rgba(86, 86, 86, 0.46);}

    	.single-post .a-avt a h5:hover{
    		color: #fd0054 !important;
    	}

    	.single-post .e-pick{
    		text-align: center;
    	}
    </style>
@endpush

@section('content')
    <!-- Start Header Area -->
    @include('layouts.frontend.partial.global.front_header')
    <!-- End Header Area -->

	<!-- Start top-post Area -->
	<section class="top-post-area">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 p-0">
					<div class="hero-nav-area">
						<h1 class="text-white">{{ $title }}</h1>
						<p class="text-white link-nav">
							<a href="{{ route('home') }}">Home </a>
							<span class="lnr lnr-arrow-right"></span>
							<a href="" class="active">{{ $title }} </a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End top-post Area -->

	<!-- Start contact-page Area -->
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row contact-wrap">
				<!-- <div class="map-wrap" style="width:100%; height: 445px;" id="map"></div> -->
				<div class="col-lg-12 map-wrap" id="maps">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7927.32512614206!2d106.75366058323345!3d-6.
						564206896052583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1377e9bdc02eea68!2zNsKwMzMnNDkuOCJTIDEw
						NsKwNDUnMjAuNiJF!5e0!3m2!1sen!2sid!4v1495165466482" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen>
					</iframe>
				</div>
				@foreach($company as $setting)
	                <div class="col-lg-3 d-flex flex-column address-wrap">
						<div class="single-contact-address d-flex flex-row">
							<div class="icon">
								<span class="lnr lnr-home"></span>
							</div>
							<div class="contact-details">
								<h5>{{ $setting->city}} , {{ $setting->country}} </h5>
								<p>
									{{ $setting->street}}
								</p>
							</div>
						</div>
						<div class="single-contact-address d-flex flex-row">
							<div class="icon">
								<span class="lnr lnr-phone-handset"></span>
							</div>
							<div class="contact-details">
								<h5>{{ $setting->number }}</h5>
								<p>{{ $setting->open_days }}</p>
							</div>
						</div>
						<div class="single-contact-address d-flex flex-row">
							<div class="icon">
								<span class="lnr lnr-envelope"></span>
							</div>
							<div class="contact-details">
								<h5>{{ $setting->webmail }}</h5>
								<p>For Feedback or enquiry</p>
							</div>
						</div>
					</div>
				@endforeach
				<div class="col-lg-9">
					<form method="post" action="{{ route('contact.store') }}" class="form-area text-right" id="">
						@csrf
						<div class="row">
							<div class="col-lg-6">
								<input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
								 class="mb-15 form-control" required="" type="text">

								<input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
								 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-15 form-control"
								 required="" type="email">
								<input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'"
								 class="common-input mb-15 form-control" required="" type="text">
							</div>
							<div class="col-lg-6">
								<textarea class="common-textarea form-control" name="message" placeholder="Enter Messege" onfocus="this.placeholder = ''"
								 onblur="this.placeholder = 'Enter Messege'" required=""></textarea>
							</div>
							<div class="col-lg-12">
								<div class="alert-msg" style="text-align: left;"></div>
								<button class="primary-btn fill" style="float: right;">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- End contact-page Area -->

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection
