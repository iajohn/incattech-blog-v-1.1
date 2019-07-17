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
                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.author.index') }}">{{ __('Authors') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $user->firstname }} - {{ $user->lastname }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header mt-3">
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <!-- <h4>{{ $user->username }} {{ __('Profile') }}</h4> -->
                            </div>

                            <div class="col-sm-4">
                                <a href="{{ route('admin.author.profile.edit', ['id' => $user->id ]) }}" class="btn btn-sm btn-primary">{{ __('Edit profile') }}</a>
                                <a href="{{ route('admin.author.index') }}" class="btn btn-sm btn-secondary">{{ __('All users') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="firstinfo">
                        <!-- <img src="{{ asset($user->profile->profile_pics) }}"/> -->
                        @if($user->profile->profile_pics)
                            <img src="{{ asset($user->profile->profile_pics) }}" 
                                 alt="{{ $user->username }}">
                        @else
                            <span style="width: 80px; height: 80px; border-radius: 50px;line-height:55px;
                                  background: #ccc;border: 1px solid #ccc;padding: 10px 16px;text-align:center;
                                  text-transform: uppercase;">
                                   {{ substr($user->username, 0, 1) }}
                            </span>
                        @endif
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
                                    <h5><strong>{{ __('Firstname') }}</strong></h5> 
                                    <p class="profile-info">{{ $user->firstname }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5><strong>{{ __('Lastname') }}</strong></h5> 
                                    <p class="profile-info">{{ $user->lastname }}</p>
                                </div>
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