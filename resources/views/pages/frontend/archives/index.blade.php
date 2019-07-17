@extends('layouts.frontend.front_app')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'all',
        'author'        => 'Incattech.com',
        'site_name'     =>  config('app.name', 'Laravel'),
        'title'         => $title,
        'type'          => 'articles',
        'url'           => route('archive'),
        'image'         => asset('assets/frontend/themes/img/preview_dark.png'),
        'description'   => 'Welcome to Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'keywords'      =>  $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
    ])
@stop

@section('title',$title)

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/post/singlepost.css') }}" rel="stylesheet">
    <style type="text/css">
    	.card {
		    position: relative;
		    display: -ms-flexbox;
		    display: flex;
		    -ms-flex-direction: column;
		    flex-direction: column;
		    min-width: 0;
		    word-wrap: break-word;
		    background-color: #fff;
		    background-clip: border-box;
		    border: 1px solid rgba(0, 0, 0, .125);
		    border-radius: 0px !important;
		}
		.card .header {
		    color: #555;
		    padding: 20px;
		    position: relative;
		    /*border-bottom: 1px solid rgba(204, 204, 204, 0.35);*/
		}
		.card .header h3 {
		    text-transform: uppercase;
		}
		.card .body {
		    font-size: 14px;
		    color: #555;
		    padding: 20px;
		}
    	.sample-text-area {
		    padding: 50px 0px 70px 0;
		}
		.sample-text-area .card .body .block-body .archive-tags {
		    padding: 0;
		    margin: 0;
		    display: flex;
		    flex-wrap: wrap;
		}
		.sample-text-area .card .body .block-body .archive-tags li {
		    display: inline-block;
		}
		.sample-text-area .card .body .block-body .archive-tags li a:first-child {
		    margin-left: 0;
		}
		.sample-text-area .card .body .block-body .archive-tags li a {
		    padding: 7px 12px;
		    color: #848f9a;
		    border: 1px solid #848f9a;
		    margin: 0 5px;
		    text-decoration: none;
		    display: inline-block;
		    margin-bottom: 5px;
		    transition: all .3s;
		    -moz-transition: all .3s;
		    -webkit-transition: all .3s;
		    -o-transition: all .3s;
		    font-size: 14px;
		}
		.sample-text-area .card .body .block-body .archive-tags .btn {
		    border-radius: 0px;
		}

		
		.skin-default .hero-nav-area .text-white {
		    color: #999 !important;
		}
		.skin-default .card{
			background-color: #f9f9f9 !important;
			border: 1px solid #d0d0d0 !important;
		}
		.skin-default .card .header {
		    border-bottom: 1px solid #d0d0d0;
		}
		.skin-default .header-title {
		    font-size: 15px;
		    font-weight: 600;
		    text-transform: capitalize;
		    position: relative;
		    text-align: left;
		    color: #fd0054;
		}
		.skin-default .sample-text-area {
		    background: #f9f9ff;
		}


		.skin-dark .card{
			background-color: #252525 !important;
			border: 1px solid #2e2e2e;
		}
    	.skin-dark .card .header {
		    border-bottom: 1px solid #2e2e2e;
		}
		.skin-dark .header-title {
		    font-size: 15px;
		    font-weight: 600;
		    text-transform: capitalize;
		    position: relative;
		    text-align: left;
		    color: #fd0054;
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
			<div class="sample-text row">
				<div class="col-md-6 mb-5">
					<div class="card">
						<div class="header">
							<h3 class="header-title">{{ __('Posts By Categories') }}</h3>
						</div>

						<div class="body">
							<div class="block-body">
		                        <ul class="archive-tags">
		                            @foreach($categories as $cat)
		                                <li>
		                                    <a href="{{ route('category.posts', [ 'slug' => $cat->slug ]) }}" class="btn primary-btn">
		                                        {{ $cat->name }} ({{ $cat->posts->count() }})
		                                    </a>
		                                </li>
		                            @endforeach
		                        </ul>
		                    </div>
						</div>
					</div>
				</div>

				<div class="col-md-6 mb-5">
					<div class="card">
						<div class="header">
							<h3 class="header-title">{{ __('Posts by Tags') }}</h3>
						</div>

						<div class="body">
							<div class="block-body">
		                        <ul class="archive-tags">
		                            @foreach($tags as $tag)
		                                <li>
		                                    <a href="{{ route('tag.posts', [ 'slug' => $tag->slug ]) }}" class="btn primary-btn">
		                                        {{ $tag->name }} ({{ $tag->posts->count() }})
		                                    </a>
		                                </li>
		                            @endforeach
		                        </ul>
		                    </div>
						</div>						
					</div>
				</div>
			</div>

			<div class="sample-text row">
				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<h3 class="header-title">{{ __('Posts by Months') }}</h3>
						</div>

						<div class="body">
							<div class="block-body">
		                        <ul class="archive-tags">
		                        	@if($archives)
		                        		@foreach($archives as $stats)
					                        <li>
					                            <a href="">
					                                {{ $stats['month'] .' ' . $stats['year'] }} ({{ $stats['published'] }})
					                            </a>
					                        </li>
					                    @endforeach
					                    @else
					                    	<p>There are no 'Archives posts' at the moment, please check later!</p>
					                @endif
		                        </ul>
		                    </div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="header">
							<h3 class="header-title">{{ __('Top 5 Most Viewed Post') }}</h3>
						</div>

						<div class="body">
							<div class="block-body">
		                        <ul class="archive-tags">
		                            @foreach($top as $posts)
		                                <li>
		                                    <a href="{{ route('post.details', [ 'slug' => $posts->slug ]) }}" class="btn primary-btn">
		                                        {{ str_limit($posts->title, $limit = 30, $end = ' '.'...') }} ({{ $posts->view_count }})
		                                    </a>
		                                </li>
		                            @endforeach
		                        </ul>
		                    </div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Sample Area -->

	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection