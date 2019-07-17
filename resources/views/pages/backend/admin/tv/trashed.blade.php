@extends('wpanel.master')

@section('title','Trashed Posts')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="card">
        <div class="mt-3 mb-0 ml-3">
            <div class="form-group row">
                <div class="col-sm-8">
                    <h4>Trashed Posts</h4>
                </div>

                <div class="col-sm-4">
                    <a href="{{ route('admin.post.index') }}" class="btn btn-primary">Posts</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                        @if($posts->count() > 0)
                            @foreach ($posts as $p)
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/uploads/post/thumb/'.$p->featuredImg ) }}" alt="{{ $p->title }}" style="width: 90px; height: 50px; border-radius: 5px;">
                                    </td>

                                    <td>
                                        {{ $p->title }}
                                    </td>

                                    <td class="text-center">
                                        <!-- <a href="{{ route('admin.post.edit', ['id' => $p->id ]) }}" class="btn btn-xs btn-info">
                                            Edit
                                        </a> -->

                                        <a href="{{ route('admin.post.restore', ['id' => $p->id ]) }}" class="btn btn-xs btn-success">
                                            Restore
                                        </a>

                                        <button class="btn btn-danger btn-xs waves-effect" type="button" onclick="deletePost({{ $p->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{ $p->id }}" action="{{ route('admin.post.destroy',$p->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <th colspan="5" class="alert alert-info text-center">
                                    You do not have any trashed post at the moment!
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
        function deletePost(id) {
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