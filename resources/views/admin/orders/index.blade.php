@extends('admin.layouts.layout')

@section('style')


<!-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> -->

<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список заказов</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
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
                <form action="{{ route('search.orders') }}" method="get">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список заказов</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Добавить
                            заказ</a>
                        @if (count($orders))
                        <table @if(Auth::user()->status_id == 1) id="example1" @endif class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Тип</th>
                                    <th>Когда начинать</th>
                                    <th>Статус</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->start }}</td>
                                    <td>
                                        <a href="{{ route('orders.edit',['order'=>$item->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('orders.destroy',['order'=>$item->id]) }}" method="post" class="float-left" style="margin-right: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('orders.wayclose',['order'=>$item->id]) }}" method="post" class="float-left">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Закрыть сделку?')">
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Тип</th>
                                    <th>Когда начинать</th>
                                    <th>Статус</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <p>Заказов пока нет...</p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $orders->onEachSide(2)->appends(['search' => request()->search])->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')

<!-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<!-- DataTables  & Plugins -->
<!-- <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> -->

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
            "responsive": true,
            "paging": false,
            "searching": true,
            "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

@endsection