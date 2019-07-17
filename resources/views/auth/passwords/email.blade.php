@extends('layouts.frontend.auth')

@section('title','Login')

@push('css')
	<link href="{{ asset('assets/frontend/themes/css/auth/style.css') }}" rel="stylesheet" />
	<style type="text/css">
		section.first {
		    padding-top: 80px;
		    padding-bottom: 30px;
		    transition: all 0.5s;
		    -webkit-transition: all 0.5s;
		    -o-transition: all 0.5s;
		    -moz-transition: all 0.5s;
		}
		section.login-content-area{
			padding-top: 30px;
			padding-bottom: 30px;
		}
		section .container {
		    padding-left: 15px;
		    padding-right: 15px;
		}
		.box-wrapper {
		    width: 400px;
		    margin: 0 auto;
		}
		.box.box-border {
		    box-shadow: none;
		    border: 1px solid #ccc;
		}
		.box {
		    background-color: #fff;
		    border-radius: 3px;
		    box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
		}
		.box .box-body {
		    padding: 30px;
		}
		.box .box-body h4 {
	    	margin-bottom: 30px;
		    font-size: 26px;
		    color: #999;
		}
		.form-group {
		    margin-bottom: 15px;
		}
		.form-group label {
		    margin-bottom: 5px;
		    font-size: 14px;
		    font-weight: 400;
		}
		.form-group .form-control {
		    border-radius: 0;
		    font-family: 'Lato';
		    font-weight: 300;
		    border-radius: 0;
		    height: 40px;
		}
		.form-group label.fw {
		    display: block;
		}
		a.facebook {
		    background-color: #3b5998;
		    color: #fff !important;
		}
		.btn-social {
		    font-weight: 400;
		    padding-left: 25px;
		    padding-right: 25px;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
		.btn {
		    font-size: 15px;
		    border-radius: 0;
		    padding-left: 20px;
		    padding-right: 20px;
		    border-color: transparent;
		    padding-top: 10px;
		    padding-bottom: 10px;
		    letter-spacing: .5px;
		}
		a, .btn {
		    transition: all 0.5s;
		    -webkit-transition: all 0.5s;
		    -o-transition: all 0.5s;
		    -moz-transition: all 0.5s;
		}

		.btn-magz {
		  background-color: transparent;
		  color: #F73F52;
		  transition: all 0.5s;
		  -webkit-transition: all 0.5s;
		  -o-transition: all 0.5s;
		  -moz-transition: all 0.5s;
		  border-color: #F73F52;
		  position: relative;
		  overflow: hidden;
		  z-index: 2;
		}
		.btn-magz:after {
		  position: absolute;
		  bottom: -20px;
		  left: 20px;
		  width: 5px;
		  height: 5px;
		  opacity: 0;
		  border-radius: 50%;
		  content: ' ';
		  background-color: #F73F52;
		  z-index: -1;
		  transition: all .3s;
		  -moz-transition: all .3s;
		  -o-transition: all .3s;
		  -webkit-transition: all .3s;
		}
		.btn-magz:focus:after, .btn-magz:hover:after {
		  transform: scale(200);
		  -webkit-transform: scale(200);
		  -moz-transform: scale(200);
		  -o-transform: scale(200);
		  opacity: 1;
		  transition: all 1s;
		  -moz-transition: all 1s;
		  -webkit-transition: all 1s;
		  -o-transition: all 1s;
		}
		.btn-magz:focus {
		  color: #fff;
		}
		.btn-magz:hover {
		  background-color: transparent;
		  color: #fff !important;
		}
		.btn-magz i {
		  margin-left: 10px;
		}
		.btn-magz.white {
		  color: #fff;
		}
		.btn-magz.white:after {
		  background-color: #fff;
		}
		.btn-magz.white:focus, .btn-magz.white:hover {
		  color: #F73F52 !important;
		}
	</style>
@endpush

@section('content')
	<!-- Start Header Area -->
    @include('layouts.frontend.partial.global.front_header')
    <!-- End Header Area -->
   <!-- Start top-post Area -->
    <section class="first">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="hero-nav-area">
                        <!-- <h1 class="text-white">News Category</h1> -->
                        <p class="text-white link-nav">
                            <a href="{{ route('home') }}">Home </a>
                            <span class="lnr lnr-arrow-right"></span>
                            <a href="" class="active">
                            	{{ __('Reset Password') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-post Area -->

    <section class="login-content-area">
        <div class="container">
            <div class="row">
            	<div class="container">
					<div class="box-wrapper">				
						<div class="box box-border">
							<div class="box-body">
								<form method="POST" action="{{ route('password.email') }}">
									@csrf

									<div class="form-group">
										<label>Email Address</label>
										<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
										       name="email" value="{{ old('email') }}" required>

		                                @if ($errors->has('email'))
		                                    <span class="invalid-feedback">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									</div>

									<div class="form-group text-right">
		                                <button type="submit" class="btn btn-primary btn-block">
		                                    {{ __('Send Password Reset Link') }}
		                                </button>
			                        </div>
									<div class="form-group text-center">
										<span class="text-muted">Back to login?</span> <a href="{{ route('login') }}" title="{{ __('login') }}">Login</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- start footer Area -->
    @include('layouts.frontend.partial.global.front_footer')
    <!-- End footer Area -->
@endsection

@push('js')

@endpush