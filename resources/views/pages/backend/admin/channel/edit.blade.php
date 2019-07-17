@extends('wpanel.master')

@section('title','Tv-Channel')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          Edit CATEGORY
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.tv-channel.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Channel Name</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="file" name="image">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="">
                                        <img class="img-responsive rounded" style="width: 350px; height:200px;"
                                             src="{{ asset('assets/uploads/channel/slider/'.$category->featuredImg) }}" >
                                    </div>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tv-channel.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush