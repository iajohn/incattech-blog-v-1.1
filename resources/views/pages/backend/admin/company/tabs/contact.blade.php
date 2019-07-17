<div role="tabpanel" class="tab-pane fade" id="update_contact">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.company-settings.update') }}" class="form-horizontal"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!--==================================================
                    CONTACT DETAILS
        ===================================================-->
        <!-- Name, Opens_days -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-control-label pL">
                        <label for="name">{{ __("Company's Name") }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Name" name="name" value="{{ $company->name }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-control-label pL">
                        <label for="opens">{{ __('Opens') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="opens" class="form-control {{ $errors->has('opens') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Opening Days" name="opens" value="{{ $company->open_days }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="country">{{ __("Company's Country") }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="country" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Country" name="country" value="{{ $company->country }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="city">{{ __('City') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="city" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's City" name="city" value="{{ $company->city }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="street">{{ __('Street') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="street" class="form-control {{ $errors->has('street') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Street" name="street" value="{{ $company->street }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email, Webmail, Number -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="email_address">{{ __('Email Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Email Address" name="email" value="{{ $company->email }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="email_address">{{ __('Webmail Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" id="webmail" class="form-control {{ $errors->has('webmail') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Webmail Address" name="webmail" value="{{ $company->webmail }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="number">{{ __('Number') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Number" name="number" value="{{ $company->number }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facebook, Instagram, Twitter -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="facebook_address">{{ __('Facebook Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="facebook" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Facebook Address" name="facebook" value="{{ $company->facebook }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="instagram_address">{{ __('Instagram Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="instagram" class="form-control {{ $errors->has('instagram') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Instagram Address" name="instagram" value="{{ $company->instagram }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-control-label pL">
                        <label for="twitter_address">{{ __('Twitter Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="twitter" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter Company's Twitter" name="twitter" value="{{ $company->twitter }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Name, Address -->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-control-label pL">
                        <label for="whatsapp_address">{{ __("WhatsApp Address") }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="whatsapp" class="form-control {{ $errors->has('whatsapp') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter WhatsApp Address" name="whatsapp" value="{{ $company->whatsapp }}" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-control-label pL">
                        <label for="youtube_address">{{ __('YouTube Address') }}</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="youtube" class="form-control {{ $errors->has('youtube') ? ' is-invalid' : '' }}" 
                                       placeholder="Enter YouTube Address" name="youtube" value="{{ $company->youtube }}" required autofocus>
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