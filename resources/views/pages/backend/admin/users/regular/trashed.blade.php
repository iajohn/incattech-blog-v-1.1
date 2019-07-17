@extends('layouts.backend.neutral')

@section('title','Trashed Users')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
        <div class="mt-3 mb-0 ml-3">
            <div class="form-group row">
                <div class="col-sm-8">
                    <h4>Trashed Users</h4>
                </div>

                <div class="col-sm-4">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-xs">Users</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>RESTORE</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if($authors->count() > 0)
                        @foreach ($authors as $u)
                            <tr>
                                <td>
                                    @if($u->profile->profile_pics)
                                        <img src="{{ asset($u->profile->profile_pics) }}" alt="{{ $u->username }}" 
                                             style="width: 50px; height: 50px; border-radius: 50px;">
                                    @else
                                        <span style="width: 80px; height: 80px; border-radius: 50px;line-height:55px;
                                              background: #ccc;border: 1px solid #ccc;padding: 10px 16px;text-align:center;
                                              text-transform: uppercase;">
                                               {{ substr($u->username, 0, 1) }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $u->firstname }} {{ $u->lastname }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.user.restore', ['id' => $u->id ]) }}" class="btn btn-xs btn-success">
                                        Restore
                                    </a>
                                </td>

                                <td>
                                    <button class="btn btn-danger btn-xs waves-effect" type="button" onclick="deleteAuthors({{ $u->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{ $u->id }}" action="{{ route('admin.user.destroy',$u->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <th colspan="5" class="alert alert-info text-center">
                                You do not have any trashed user at the moment!
                            </th>                   
                        </tr>

                    @endif
                </tbody>
            </table>
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