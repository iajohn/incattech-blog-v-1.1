@extends('layouts.backend.neutral')

@section('title', $user->firstname . '-' . $user->lastname )

@push('css')
    <link href="{{ asset('assets/backend/css/user_card.css') }}" rel="stylesheet">
    <style type="text/css">
        .badgescard{
            display: grid;
            justify-content: center;
            align-items: center;

        }

        .badgescard .header{
            text-align: center;
            text-transform: uppercase;
            padding: 20px 10px 10px;
            border-bottom: 1px solid #888;
        }

        .badgescard .profile h5 {
            text-transform: uppercase;
        }

        .badgescard .profile .profile-info{
            font-size: 12px;
            color: #888;
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
                                <a href="{{ route('author.dashboard') }}">{{ __('Home') }}</a>
                            </li>

                            <li class="breadcrumb-item active">{{ $user->firstname }} - {{ $user->lastname }} - {{ __('Profile') }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header mt-3">
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <!-- <h4>{{ $user->name }} {{ __('Profile') }}</h4> -->
                            </div>

                            <div class="col-sm-4">
                                <a href="{{ route('author.profile.edit') }}" class="btn btn-sm btn-primary">{{ __('Edit profile') }}</a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="firstinfo">
                        <img src="{{ asset($user->profile->profile_pics) }}"/>
                        <div class="profileinfo">
                            <div class="header">
                                <h2> {{ $user->firstname }} - {{ $user->lastname }} </h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="badgescard">
                            <div class="header">
                                <h2><strong>{{ __('Profile Details') }}</strong></h2> 
                            </div>

                            <div class="row justify-content-center profile">
                                <div class="col-md-6">

                                    <h5><strong>{{ __('Username') }}</strong></h5> 
                                    <p class="profile-info">{{ $user->username }}</p>

                                </div>

                                <div class="col-md-6">

                                    <h5><strong>{{ __('Email') }}</strong></h5> 
                                    <p class="profile-info">{{ $user->email }}</p>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection