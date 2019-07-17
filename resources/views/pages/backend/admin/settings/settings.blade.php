@extends('layouts.backend.app')

@section('title','Settings')

@push('css')

@endpush


@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="header">
                        <h2>
                            SYSTEM SETTINGS
                        </h2>
                    </div>
                    
                    <div class="body">
                        @include('pages.backend.admin.settings.form')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush