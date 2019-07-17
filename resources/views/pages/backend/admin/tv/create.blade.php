@extends('wpanel.master')

@section('title','Tv')

@section('content')
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3>
                        <i class="font-icon font-icon-plus-1"></i> Add New Video
                    </h3>
                </div>
            </div>
        </div>
    </header>

    <section class="">
        <div class="container">
            <h5 class="with-border">New Video Data</h5>
            <form enctype="multipart/form-data" action="{{ route('admin.tv.store') }}"
                  method="post" class="">

                @csrf
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body">
                                <fieldset class="form-group">
                                    <label class="form-label" for="video_title">Video title</label>
                                    <input type="text" class="form-control"
                                           id="video_title" name="video_title" value="{{ old('video_title') }}" placeholder="Video Title" />
                                </fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Video Image Cover (1280x720 px or 16:9 ratio)</label>
                                            <input type="file" class="form-control" name="video_image" id="video_image" />
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset class="form-group form-float">
                                            <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                                            <label for="publish">Publish</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <!-- <div class="header">
                                <h2>
                                    Channels and Tags
                                </h2>
                            </div> -->
                            <div class="body">
                                <fieldset class="form-group">
                                    <label class="form-label" for="video_category">Select Channel</label>
                                    <select name="video_category[]" id="video_category" class="bootstrap-select bootstrap-select-arrow" data-live-search="true" multiple>
                                        <option value="0">Uncategorized</option>
                                        @foreach($channels as $category)
                                            <option value="{{ $category->id }}"
                                            @if($category->id == old('video_category'))
                                                {{ 'selected="selected"' }}
                                            @endif
                                            >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>

                                <fieldset class="form-group form-float">
                                    <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                        <label for="tag">Video tags</label>
                                        <input type="text" class="form-control maxlength-simple" id="video_tags" value="{{ old('video_tags') }}"
                                               name="video_tags" placeholder="Tags" />
                                    </div>
                                </fieldset>

                                <fieldset class="form-control">
                                    <a  class="btn btn-rounded btn-inline btn-danger m-t-15 " href="{{ route('admin.tv.index') }}">BACK</a>
                                    <button type="submit" class="btn btn-rounded btn-inline btn-success m-t-15">SUBMIT</button>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <!-- <div class="header">
                                <h2>
                                   VIDEO DETAILS
                                </h2>
                            </div> -->
                            <div class="body">
                                <fieldset class="form-group">
                                    <label class="form-label" for="video_details">Video Details, Links, and Info</label>
                                    @include('tinymce::tpl')
                                    <textarea id="tinymce" class="tinymce" name="video_details" id="video_details">
                                        {{ old('video_details') }}
                                    </textarea>
                                </fieldset>

                                <fieldset class="form-group">
                                    <div class="panel-body">
                                        <label class="form-label" for="video_desc">Short description of the video</label>
                                            <textarea rows="3" class="form-control" name="video_desc" id="video_desc"
                                                      placeholder="Textarea">{{ old('video_desc') }}</textarea>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <!-- <div class="header">
                                <h2>
                                   USER ACCESS - DURATION - STATUS
                                </h2>
                            </div> -->
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="video_access">Who can view this video?</label>
                                            <select class="bootstrap-select bootstrap-select-arrow" id="video_access" name="video_access">
                                                <option value="guest"
                                                @if(old('video_access') == "guest")
                                                    {{ 'selected="selected"' }}
                                                @endif
                                                >Everyone</option>
                                                <option value="registered"
                                                @if(old('video_access') == "registered")
                                                    {{ 'selected="selected"' }}
                                                @endif
                                                >Registered Users</option>
                                                <option value="subscriber"
                                                @if(old('video_access') == "subscriber")
                                                    {{ 'selected="selected"' }}
                                                @endif
                                                >Subscriber</option>
                                            </select>
                                            <small class="text-muted">User Access</small>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <fieldset class="form-group">
                                            <div class="checkbox-toggle">
                                                <input type="checkbox" id="featured" name="featured" value="1"
                                                   @if(old('featured') != "")
                                                   {{ 'checked' }}
                                                   @endif
                                                />
                                                <label for="featured">Is this video Featured</label>
                                            </div>
                                            <div class="checkbox-toggle">
                                                <input type="checkbox" id="active" name="active" value="1"
                                                @if(!old('active'))
                                                    {{ 'checked' }}
                                                @elseif(old('active') != "")
                                                    {{ 'checked' }}
                                                @endif
                                                />
                                                <label for="active">Is this video Active</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <!-- <div class="header">
                                <h2>
                                    VIDEO SOURCE
                                </h2>
                            </div> -->
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group form-float">
                                            <fieldset class="form-group">
                                                <label for="">Video Duration</label>
                                                <input type="text" name="video_duration" id="video_duration"  class="form-control"
                                                       value="{{ old('video_duration') }}" />
                                            </fieldset>
                                            <small class="text-muted">Video duration: HH:MM:SS</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <fieldset class="form-group form-float">
                                            <div class="form-line {{ $errors->has('channels') ? 'focused error' : '' }}">
                                                <label for="">Select Video Type</label>
                                                <select id="video_type" name="video_type" class="bootstrap-select bootstrap-select-arrow">
                                                    <option value="embed"
                                                    @if(old('video_type') == "embed")
                                                        {{ 'selected="selected"' }}
                                                    @endif
                                                    >Embed Code</option>
                                                    <option value="file"
                                                    @if(old('video_type') == "file")
                                                        {{ 'selected="selected"' }}
                                                    @endif
                                                    >Video File</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div class="new_video_file" style="display: none">
                                                <div id="dZUpload" class="dropzone">
                                                    <div class="dz-default dz-message">Drop files here to upload</div>
                                                </div>
                                                <input type="hidden" name="video_location" id="video_location" value="{{ old('video_location') }}" />
                                            </div>

                                            <div class="new_video_embed" >
                                                <label for="embed_code">Embed Code:</label>
                                                <textarea id="tinymceV" class="form-control" name="embed_code" id="embed_code">{{ old('embed_code') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop

@section('head')
    <link rel="stylesheet" href="{{ asset('wpanel/js/tagsinput/jquery.tagsinput.css') }}" />
    <link rel="stylesheet" href="{{ asset('wpanel/js/dropzone/dropzone.css') }}" />
@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('wpanel/js/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wpanel/js/input-mask/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wpanel/js/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript">
        $('#video_tags').tagsInput();
        $('#video_duration').mask('00:00:00', {placeholder: "__:__:__"});

        Dropzone.autoDiscover = false;

        $(function() {

            $('#video_type').change(function(){
                changeVideoSourceOption(this);
            });

            var baseUrl = "{{ url('/') }}";
            Dropzone.autoDiscover = false;
            $("#dZUpload").dropzone({
                url: baseUrl + "/admin/videos/upload",
                headers: {
                    'X-CSRF-Token': '{{ Session::Token() }}'
                },
                maxFilesize : 1024,  // MB
                maxFiles : 1,
                paramName : "file",
                addRemoveLinks: true,
                success: function (file, response) {
                    console.log(response);
                    $('#video_location').val(response.message);
                }

            });

            @if(session()->has('info'))
                $.notify({
                    icon: 'font-icon font-icon-check-circle',
                    message: '{{ session()->get('info') }}'
                },{
                    type: 'success'
                });
            @endif
        });
    </script>

    <!-- TinyMCE -->
    <!-- // <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script> -->
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymceV",
                theme: "modern",
                height: 300,
                plugins: [
                    'link charmap preview hr anchor pagebreak',
                    'searchreplace visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save directionality',
                    'emoticons imagetools'
                ],
                toolbar1: 'insertfile undo redo | link media',
                // toolbar2: 'print preview| forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>
@stop