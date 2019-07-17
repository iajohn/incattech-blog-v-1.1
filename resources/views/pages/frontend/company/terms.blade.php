@extends('layouts.frontend.company')

@section('title',$title)

@push('css')
    <link href="{{ asset('assets/frontend/themes/css/skins/themes.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/frontend/themes/css/default/main.css') }}" rel="stylesheet"> -->
    <style type="text/css">
    	.navbar-brand img {
		    max-width: 165px;
		    max-height: 36px;
		    height: auto;
		}
		.logo {
		    padding-bottom: 30px !important;
		    padding-left: 30px;
		    padding-top: 24px !important;
		}
		p.text-white.link-nav a.active {
		    color: #fd0054; 
		}
		.skin-dark #main-wrapper h2.title {
    		color: #555 !important;
    	}

    	aside.left-sidebar{
    		overflow-y: auto;
    		height: 100%;
    		width: 20%
    	}
    	aside.left-sidebar .left-nav{
    		position: relative;
		    overflow: hidden;
		    width: auto;
		    /*height: 418px;*/
    	}
    	aside.left-sidebar .left-nav ul {
		    overflow: hidden;
		    width: auto;
		    /*height: 418px;*/
		    list-style: none;
		    padding-left: 0;
		}
		#main-wrapper {
		    float: left;
		    margin-left: 20%;
		    width: 80%;
		    padding-bottom: 25px;
		}
		.main-content section {
		    padding: 2% 5%;
		    margin: 0px !important;
		}
		.title {
		    margin: 20px 0 20px;
		}
    </style>
@endpush

@section('content')
    
    @include('pages.frontend.company.includes.aside.terms')
	<div id="main-wrapper">
		<div class="row">
			<div class="col-lg-12 p-0">
				<div class="hero-nav-area">
					<h1 class="text-white">{{ $title }}</h1>
					<p class="text-white link-nav">
						<a href="{{ route('home') }}">Home </a>
						<span class="fa fa-angle-right pl-1 pr-1"></span>
						<a href="" class="active">{{ $title }}</a>
					</p>
				</div>
			</div>
		</div>
        @if ($company)
		    @foreach($company as $setting)
			    <div class="main-content">
		    		@if ($setting->policy_body)
		    			{!! html_entity_decode($setting->terms_body) !!}
		    			@else
							@include('pages.frontend.company.includes.terms')
		    		@endif
		    		<section id="contact">
						<h2 class="twenty"> Contacting Us. </h2>
						<p class=" fifteen " style="text-align: justify;">If you have any questions, concerns or suggestions about this Privacy Policy, you may contact us at <em><a href="mailto:legal@incattech.com">legal@incattech.com</a></em> or at the following address:</p>
						<div class="script-source" style="text-align: justify;">{{ $setting->name }}.</div>
						<!-- <div class="script-source" style="text-align: justify;">Attn.: Privacy Policy Issues</div> -->
						<div class="script-source" style="text-align: justify;">{{ $setting->street }}</div>
						<div class="script-source" style="text-align: justify;">{{ $setting->country }} {{ $setting->city }}</div>         
					</section>
		    		
		    		<section>
		    			<div class="question">
							Have a question? <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
						</div>
					</section>
			    </div>
            @endforeach
        @endif
	</div>
			
@endsection
