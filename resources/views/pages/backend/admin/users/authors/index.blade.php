@extends('layouts.backend.app')

@section('title','Authors')

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
                                {{ __('Authors') }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            {{ __('ALL AUTHORS') }}
                            <span class="badge bg-blue">{{ $authors->count() }}</span>
                        </h2>

                        <ul class="header-dropdown m-r--5">
                            <a href="{{ route('admin.author.trashed') }}" title="Trashed Users" class="btn btn-danger waves-effect btn-xs" >
                                <i class="material-icons">delete</i>
                            </a>
                        </ul>
                    </div>

                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                                                        
                            <li role="presentation" class="active">
                                <a href="#authors_index" data-toggle="tab">
                                    <i class="material-icons">account_circle</i> INDEX
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#add_new_author" data-toggle="tab">
                                    <i class="material-icons">change_history</i> ADD USER
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active " id="authors_index">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>IMAGE</th>
                                                <th>Name</th>
                                                <th>Posts</th>
                                                <th>Favorite Posts</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Posts</th>
                                                <th>Favorite Posts</th>
                                                <th>Created At</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @if($authors->count() > 0)
                                                @foreach($authors as $key=>$author)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                           @if($author->profile->profile_pics)
                                                                <img src="{{ asset($author->profile->profile_pics) }}" 
                                                                     alt="{{ $author->username }}" style="width: 35px; height: 35px; border-radius: 50px;">
                                                            @else
                                                                <span style="width: 35px; height: 35px; border-radius: 50px; 
                                                                      background: #ccc;border: 1px solid #ccc;padding: 10px 16px;
                                                                      text-transform: uppercase;">
                                                                       {{ substr($author->username, 0, 1) }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $author->firstname }}  {{ $author->lastname }}</td>
                                                        <td>{{ $author->posts_count }}</td>
                                                        <!-- <td>{{ $author->comments_count }}</td> -->
                                                        <td>{{ $author->favorite_posts_count }}</td>
                                                        <td>{{ $author->created_at->toFormattedDateString() }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.author.profile', ['id' => $author->id ]) }}" class="btn btn-info btn-xs waves-effect">
                                                                <i class="material-icons">visibility</i>
                                                            </a>

                                                            <a href="{{ route('admin.author.profile.edit', ['id' => $author->id ]) }}" class="btn btn-primary btn-xs waves-effect">
                                                                <i class="material-icons">edit</i>
                                                            </a>

                                                            @if(Auth::id() !== $author->id)
                                                                <a href="{{ route('admin.author.delete', ['id' => $author->id ]) }}" class="btn btn-danger btn-xs waves-effect">
                                                                    <i class="material-icons">delete</i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <th colspan="5" class="alert alert-info text-center">
                                                            There are no record of authors at the moment!
                                                        </th>                   
                                                    </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="add_new_author">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                </br>
                                <form method="POST" action="{{ route('admin.author.store') }}" class="form-horizontal"  enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <!--==================================================
                                                USER DETAILS
                                    ===================================================-->
                                    <!-- Firstname $ Lastname -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="first_name">{{ __('First Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="firstname" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter firstname" name="firstname" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="last_name">{{ __('Last Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="lastname" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter lastname" name="lastname" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Username $ Email -->
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="username">{{ __('User Name') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter username" name="username" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="email_address">{{ __('Email Address') }}</label>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                   placeholder="Enter email address" name="email" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <!-- <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-control-label pL">
                                                    <label for="password">New Password: </label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" id="password" class="form-control" placeholder="Enter new password" name="password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">CREATE</button>
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