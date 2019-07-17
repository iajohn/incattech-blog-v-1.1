@extends('wpanel.master')

@section('title','Tv-Channel')

@section('content')
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3 style="display: inline-block">
                        <i class="font-icon font-icon-archive"></i> Video Channels
                    </h3>
                    <a data-toggle="modal" data-target="#myModal" class="label-success label">
                        <i class="font-icon font-icon-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section class="box-typical box-typical-padding">
        <h3 class="with-border" style="font-size: 1.2rem">Organize the Categories below: (max of 3 levels)</h3>
        <div class="row">
            <div class="col-md-8">
                <div class="dd" id="nestable7">
                    {!! getHTML($channel) !!}
                </div>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">New Video Channel</h4>
                </div>
                <div class="modal-body">
                    <form id="new-cat-form" action="{{ route('admin.tv-channel.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Enter the new channel name below</label>
                            <input id="category_name" name="name" placeholder="Channel Name" class="form-control"><br>
                        </div>

                        {{--<div class="form-group">
                            <input type="file" name="image">
                        </div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-rounded btn-primary" id="submit-new-cat">Save changes</button>
                </div>
            </div>
        </div>
    </div><!--.modal-->

    <!-- Update New Modal -->
    <div class="modal fade" id="update-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Update Channel</h4>
                </div>
                <div class="modal-body" id="update-modal-body" style="display: none;">                  
                    <form id="edit-cat-form" action="{{ route('admin.tv-channel.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-line">
                                <label for="channel_name">Channel Name</label>
                                <input id="category_name_edit" name="category_name_edit" placeholder="Channel Name" 
                                       class="form-control"><br>
                                <input type="hidden" name="category_id" id="category_id" value="">
                            </div>
                        </div>

                        {{--<div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="image">
                                    <input type="hidden" name="image" id="category_id" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="">
                                    <img id="featuredImg" class="img-responsive rounded" style="width: 250px; height:150px;"
                                         src="{{ asset('assets/uploads/channel/slider/') }}" >
                                </div>
                            </div>
                        </div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-rounded btn-primary" id="submit-edit-cat">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('wpanel/js/notie.js') }}"></script>
    <script type="text/javascript">
        $('#submit-new-cat').click(function(){
            $('#new-cat-form').submit();
        });

        $('#submit-edit-cat').click(function(){
            $('#edit-cat-form').submit();
        });

        $(function(){
            $('#nestable7').nestable({
                group: 1,
                maxDepth: 3
            }).on('change', function(e) {
                $.get('{{ url('/admin/tv-channel/order') }}', {
                    order : JSON.stringify($('.dd').nestable('serialize')),
                    _token : $('#_token').val()
                }, function(data){
                    console.log(data);
                });
            });

            $('.actions .edit').click(function(e){
                $('#update-category').modal('show', {backdrop: 'static'});
                e.preventDefault();
                href = $(this).attr('href');
                $.ajax({
                    url: href,
                    success: function(response) {
                        console.log(response);
                        var JsonResponse = JSON.parse(response);
                        $('#category_name_edit').val(JsonResponse.name);
                        $('#category_id').val(JsonResponse.id);
                        $('#featuredImg').val(JsonResponse.featuredImg);
                        $('#update-modal-body').css("display", "block");
                    }
                });
            });

            $('.actions .delete').click(function(e){
                if (confirm("Are you sure you want to delete this category?")) {
                    return true;
                }
                return false;
            });

            @if($errors->has('name'))
                notie.alert(3, '{{ $errors->first('name') }}', 3);
            @endif

            @if($errors->has('category_name_edit'))
                notie.alert(3, '{{ $errors->first('category_name_edit') }}', 3);
            @endif
        })
    </script>
@stop