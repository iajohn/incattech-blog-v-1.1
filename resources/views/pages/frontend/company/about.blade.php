@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $title,
        'type'          => 'articles',
        'url'           => route('about'),
        'image'         => asset('assets/frontend/themes/img/preview_dark.png'),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title',$title)

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
    	.sample-text-area {
		    padding: 10px 0px 70px 0;
		}
		.skin-default .hero-nav-area .text-white {
		    color: #999 !important;
		}

    	.skin-default .sample-text-area {
		    background: #f9f9ff;
		}

		.skin-dark .sample-text-area {
		    background: #252525;
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
							<a href="" class="active">{{ $title }}</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End top-post Area -->

	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
			<h3 class="text-heading"></h3>
			<p class="sample-text">
				@if ($company)
                    @foreach($company as $setting)
                        {!! html_entity_decode($setting->about_body) !!}
                    @endforeach
                    @else
                    
                @endif
			</p>
		</div>
	</section>
	<!-- End Sample Area -->

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection