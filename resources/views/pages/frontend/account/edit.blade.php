@extends('layouts.dev.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
        <!--breadcrumbs-->
<section id="breadcrumb">
    <div class="row">
        <div class="large-12 columns">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-home"></i><a href="{{ route('tv') }}">Home</a></li>
                    <li><a href="{{ route('user.account.user') }}">{{ $user->username }}</a></li>
                    <li>
                        <span class="show-for-sr">Current: </span> Profile Setting
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
<!--end breadcrumbs-->
<section class="topProfile">
    <div class="profile-stats">
        <div class="row secBg">
            <div class="large-12 columns">
                <div class="profile-author-img float-left">
                    @if($user->profile->profile_pics)
                        <img src="{{ asset($user->profile->profile_pics) }}" alt="profile author img">
                    @else
                        <span>{{ substr($user->username, 0, 1) }}</span>
                    @endif
                </div>
                <div class="clearfix">
                    <div class="profile-author-name float-left">
                        <h4>{{ $user->firstname }} {{ $user->lastname }}</h4>
                        <p>Join Date : <span>{{ date('j F y', strtotime($user->profile->created_at)) }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End profile top section -->
<div class="row">
    @if(count($errors) > 0)
        <div data-abide-error class="alert callout success">
            @foreach ($errors->all() as $error)
                <p><i class="fa fa-exclamation-triangle"></i> {{ $error }} </p>
            @endforeach
        </div>
    @endif
    @if(session()->has('info'))
        <div class="callout success">
            <p><i class="fa fa-info"></i> {{session()->get('info')}}. </p>
        </div>
    @endif
    @include('pages.frontend.account.sidenav')
    <!-- right side content area -->
    <div class="large-8 columns profile-inner">
        <!-- profile settings -->
        <section class="profile-settings">
            <div class="row secBg">
                <div class="large-12 columns">
                    <div class="heading">
                        <i class="fa fa-gears"></i>
                        <h4>profile Settings</h4>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="setting-form">
                                <form method="post" action="{{ route('user.account.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="setting-form-inner">
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <h6 class="borderBottom">Profile Setting:</h6>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="fullname">First Name:
                                                    <input type="text" name="firstname" value="{{ $user->firstname }}"
                                                           id="firstname" placeholder="enter your full name..">
                                                </label>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="fullname">Last Name:
                                                    <input type="text" name="lastname" value="{{ $user->lastname }}"
                                                           id="lastname" placeholder="enter your full name..">
                                                </label>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="username">Username:
                                                    <input type="text" name="username" value="{{ $user->username }}"
                                                           id="username" placeholder="enter your username..">
                                                </label>
                                            </div>
                                            <div class="medium-6 columns">
                                                <label for="email">Email:
                                                    <input type="text" id="email" value="{{ $user->email }}" disabled>
                                                </label>
                                            </div>
                                            <div class="medium-6 columns">
                                                <label for="avatar">Avatar:
                                                    <input type="file" name="profile_pics" id="avatar" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-form-inner">
                                        <button class="button" type="submit" name="setting">update now</button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('user.accountpassword.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="setting-form-inner">
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <h6 class="borderBottom">Update Password (leave empty to keep your original password):</h6>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="new_password">Old Password:
                                                    <input type="password" placeholder="enter your new password.."
                                                           name="old_password" id="old_password">
                                                </label>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="new_password">New Password:
                                                    <input type="password" placeholder="enter your new password.."
                                                           name="password" id="password">
                                                </label>
                                            </div>
                                            <div class="medium-4 columns">
                                                <label for="new_password_confirmation">Retype Password:
                                                    <input type="password" placeholder="enter your new password.."
                                                       name="new_password_confirmation" id="new_password_confirmation" >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="setting-form-inner">
                                        <button class="button" type="submit" name="setting">update now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End profile settings -->
    </div><!-- end left side content area -->
</div>
@endsection


