@extends('admin.layouts.layout')

@section('style')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/ajax.js') }}"></script> -->

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Уведомления</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Note</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-8 offset-md-2">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control form-control-lg @error('search') is-invalid @enderror" placeholder="Type your keywords here" value="{{ old('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
        <!-- <br> -->
        <div class="row">
            <div class="col-12">
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Уведомления
                        </h3>

                        <div class="card-tools">
                            {{ $note->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
                            <!-- <ul class="pagination pagination-sm">
                                <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                            </ul> -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (count($note))
                        <ul class="todo-list" data-widget="todo-list">
                            @foreach($note as $item)
                            <li id='note{{ $item->id }}'>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- todo text -->

                                <span class="text @if($item->open == 2) text-success @else text-danger @endif">{{ $item->name }}</span>
                                <!-- Emphasis label -->
                                <small class="badge @if($item->open == 2) badge-success @else badge-danger @endif"><i class="far fa-clock"></i>
                                    {{ $item->getPostDate('created_at') }}
                                </small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    @if($item->open == 2)
                                    <button type="submit" class="btn btn-danger text-white btn-sm deleteProduct" data-id="{{ $item->id }}" data-token="{{ csrf_token() }}">Удалить</button>
                                    @else
                                    <button type="submit" class="btn btn-warning text-white btn-sm updateProduct" data-id="{{ $item->id }}" data-token="{{ csrf_token() }}">Отметить</button>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>Уведомлений пока нет...</p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Отправить уведомление(админ)</button>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')

<script src="{{ asset('assets/js/ajax.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> -->

<script>
    $(document).ready(function() {

        $(".updateProduct").click(function(event) {
            var id = $(this).data('id');
            var token = $(this).data('token');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('note.update') }}",
                type: 'post',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function(response) {
                    location.reload();
                    console.log(response);
                }
            });
        });

        $(".deleteProduct").click(function(event) {
            var id = $(this).data('id');
            var token = $(this).data('token');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('note.delete') }}",
                // url: '/admin/note/update/' + id,
                type: 'post',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function() {
                    $("#note" + id).hide(500);
                }
            });
            return false;
        });

    });
</script>

@endsection