@extends('admin.layouts.layout')

@section('style')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Письма</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('search.message') }}" method="get">
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
        </div>
        <!-- <br> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список писем</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (count($messages))
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Тема</th>
                                        <th>Важность</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $item)
                                    <tr id="message{{ $item->id }}">
                                        <td><a href="{{ route('message.show', ['message'=>$item->id]) }}">{{ $item->id }}</a></td>
                                        <td><a href="{{ route('message.show', ['message'=>$item->id]) }}">{{ $item->name }}</a></td>
                                        <td><a href="{{ route('message.show', ['message'=>$item->id]) }}">{{ $item->email }}</a></td>
                                        <td><a href="{{ route('message.show', ['message'=>$item->id]) }}">{{ $item->subject }}</a></td>
                                        <td>
                                            @if($item->step==1)
                                            Обычное
                                            @else
                                            Срочное
                                            @endif
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger text-white btn-sm deleteProduct" data-id="{{ $item->id }}" data-token="{{ csrf_token() }}">
                                                <!-- Удалить -->
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <!-- <form action="{{ route('message.destroy',['message'=>$item->id]) }}" method="post" class="float-left">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                    <i class="fas fa-trash-alt"></i>
                                                     fa-unlock-alt
                                                </button>
                                            </form> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>Писем пока нет...</p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $messages->onEachSide(2)->appends(['search' => request()->search])->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                <!-- /.card -->

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

<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            // "responsive": true,
            "paging": false,
            "searching": true,
            "ordering": false,
            "info": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {

        // $(".updateProduct").click(function(event) {
        //     var id = $(this).data('id');
        //     var token = $(this).data('token');
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: "{{ route('note.update') }}",
        //         type: 'post',
        //         dataType: "JSON",
        //         data: {
        //             "id": id
        //         },
        //         success: function(response) {
        //             location.reload();
        //             console.log(response);
        //         }
        //     });
        // });

        $(".deleteProduct").click(function(event) {
            var id = $(this).data('id');
            var token = $(this).data('token');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('message.destroy') }}",
                type: 'post',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function() {
                    $("#message" + id).hide(500);
                }
            });
            return false;
        });

    });
</script>

@endsection