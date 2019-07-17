@extends('layouts.backend.neutral')

@section('title', $title)

@push('css')
    <style type="text/css">
        .form-group .form-control{
            border-bottom: 2px solid #888;
        }

        .form-group .form-control:focus{
            border-bottom: 2px solid #00b8d0;
        }

        .pL{
            text-align: left !important;
            float: left;
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb-holder">
                    <div class="container-fluid">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a>
                            </li>
                            
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.author.index') }}">{{ __('Users') }}</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.profile.index') }}">{{ __('Profile') }}</a>
                            </li>

                            <li class="breadcrumb-item active">{{ __('Update') }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            {{ __('Update') }}  {{ $user->firstname }} - {{ $user->lastname }}  {{ __('Profile') }}
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile_with_icon_title" data-toggle="tab">
                                    <i class="material-icons">face</i> UPDATE PROFILE
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#change_password_with_icon_title" data-toggle="tab">
                                    <i class="material-icons">change_history</i> CHANGE PASSWORD
                                </a>
                            </li>

                        </ul>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                <form method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal"  enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!--==================================================
                                                USER DETAILS
                                    ===================================================-->
                                    <!-- Firstname $ Lastname -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="firstname">{{ __('First Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="firstname" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter firstname" name="firstname" value="{{ $user->firstname }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="lastname">{{ __('Last Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="lastname" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter lastname" name="lastname" value="{{ $user->lastname }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Username and Occupation -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="username">{{ __('User Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter username" name="username" value="{{ $user->username }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __("Occupation/ Position") }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="occupation" class="form-control {{ $errors->has('occupation') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Author's Occupation" name="occupation" value="{{ $user->profile->occupation }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="email_address_2">Profile Image</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="file" name="image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Company and Skill -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="skill">{{ __('Skill') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="skill" class="form-control {{ $errors->has('skill') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Skill" name="skill" value="{{ $user->profile->hobbies }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="company">{{ __("Company") }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="company" class="form-control {{ $errors->has('company') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Author's Company Name" name="company" value="{{ $user->profile->company }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email, Facebook, and Instagram  -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="email_address_2">{{ __('Email Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter email address" name="email" value="{{ $user->email }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __('Facebook Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="facebook" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Facebook Address" name="facebook" value="{{ $user->profile->facebook }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __('Instagram Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="instagram" class="form-control {{ $errors->has('instagram') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Instagram Address" name="instagram" value="{{ $user->profile->instagram }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Twitter, YouTube, and WhatsApp  -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __('Twitter Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="twitter" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Twitter Address" name="twitter" value="{{ $user->profile->twitter }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __('YouTube Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="youtube" class="form-control {{ $errors->has('youtube') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter YouTube Address" name="youtube" value="{{ $user->profile->youtube }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __('WhatsApp Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="WhatsApp" class="form-control {{ $errors->has('whatsapp') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter Facebook Address" name="whatsapp" value="{{ $user->profile->whatsapp }}" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-sm-12">
                                                <div class="form-control-label pL">
                                                    <label for="First Name">{{ __("About You") }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea type="text" id="about" class="form-control {{ $errors->has('about') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Write Short Things About Author" name="about" value="" required autofocus>
                                                                   {{ $user->profile->about }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="change_password_with_icon_title">
                                <form method="POST" action="{{ route('admin.password.update') }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="old_password">Old Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password">New Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="confirm_password">Confirm Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush