@extends('admin.layouts.layout')

@section('style')

<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <!-- <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div> -->
                                <!-- todo text -->
                                <span class="text text-success @if($item->open == 1) text-danger @endif">{{ $item->name }}</span>
                                <!-- Emphasis label -->
                                <small class="badge badge-success @if($item->open == 1) badge-danger @endif"><i class="far fa-clock"></i>
                                    {{ $item->getPostDate('created_at') }}
                                </small>
                                <!-- General tools such as edit or delete-->
                                @if($item->open == 1)
                                <div class="tools">
                                    <form id="contactform" method="POST" class="float-left">
                                        @csrf
                                        <div id="sendmessage" style="display: none;">
                                            Сообщение удалено
                                        </div>
                                        <div id="senderror" style="display: none;">
                                            Сообщение не удалено
                                        </div>
                                        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-warning text-white btn-sm">
                                            <!-- <i class="fas fa-edit"></i> -->
                                            Отметить
                                            <!-- fa-unlock-alt -->
                                        </button>
                                    </form>
                                    <!-- <i class="fas fa-edit"></i> -->
                                    <!-- <i class="fas fa-trash-o"></i> -->
                                </div>
                                @endif
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

<!-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> -->

<script>
    $(document).ready(function() {
        $('#contactform').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('note.update') }}",
                data: $('#contactform').serialize(),
                success: function() {
                    location.reload();
                    // console.log(result);
                }
            });
        });
    });
</script>

@endsection