@extends('layouts.backend.neutral')

@section('title','Company Settings')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <style type="text/css">
        .form-group .form-control{
            border-bottom: 1px solid;
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
                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ __('Company Settings') }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="block-header">
                    <a href="{{ route('admin.company.about') }}" class="btn btn-xs btn-primary waves-effect">
                        <i class="material-icons">info</i> 
                        <span>ABOUT</span>
                    </a>

                    <a href="{{ route('admin.company.policy') }}" class="btn btn-xs btn-primary waves-effect">
                        <i class="material-icons">add</i> 
                        <span>POLICY</span>
                    </a>
               

                    <a href="{{ route('admin.company.terms') }}" class="btn btn-xs btn-primary waves-effect">
                        <i class="material-icons">add</i> 
                        <span>TERMS</span>
                    </a>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                           {{ __('COMPANY SETTINGS') }}
                        </h2>
                    </div>

                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                                                        
                            <li role="presentation" class="active">
                                <a href="#company_index" data-toggle="tab">
                                    <i class="material-icons">account_circle</i> INDEX
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#update_contact" data-toggle="tab">
                                    <i class="material-icons">change_history</i> CONTACT
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active " id="company_index">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @if($company)
                                                @foreach($company as $company)
                                                    <tr>
                                                        <td>{{ $company->name }}</td>
                                                        <td>{{ $company->address }}</td>
                                                        <td>{{ $company->email }}</td>
                                                        <td>{{ $company->number }}</td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <th colspan="5" class="alert alert-info text-center">
                                                            There are no record of company's details settings at the moment!
                                                        </th>                   
                                                    </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @include('pages.backend.admin.company.tabs.contact')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteAuthors(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush