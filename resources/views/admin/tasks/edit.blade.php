@extends('admin.layouts.layout')

@section('style')

<link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.css') }}">

<!-- {{ asset('assets/admin/') }} -->

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование задачи</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Задача "{{ $task->name }}"</h3>
                    </div>
                    <!-- /.card-header -->

                    <form role="form" method="post" action="{{ route('tasks.update', ['task' => $task->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Название" value="{{ $task->name }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    @foreach($works as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$task->work_id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" placeholder="Описание ...">{{ $task->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="order">Номер заказа</label>
                                <select class="form-control @error('order') is-invalid @enderror" id="order" name="order">
                                    @foreach($orders as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$task->order_id) selected @endif>{{ $item->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="step">Срочность</label>
                                <select class="form-control @error('step') is-invalid @enderror" id="step" name="step">
                                    @foreach($step as $k => $v)
                                    <option value="{{ $k }}" @if($k==$task->step) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="users">Выбор исполнителей</label>
                                <select name="users[]" id="users" class="select2 form-control" multiple="multiple" data-placeholder="Выбор исполнителей" style="width: 100%;">

                                    @foreach($users as $item)
                                    <option value="{{ $item->id }}" @if(in_array($item->id, $task->user->pluck('id')->all())) selected @endif>{{ $item->name }}-{{ $item->status->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>С какого числа начинать:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name='date1' class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $task->dateEdit('created_at') }}">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>До какого числа начинать:</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="text" name='date2' class="form-control datetimepicker-input" data-target="#reservationdate2" value="{{ $task->dateEdit('updated_at') }}">
                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="open">Закрыть?</label>
                                <select class="form-control @error('open') is-invalid @enderror" id="open" name="open">
                                    <option value="1">Открыт</option>
                                    <option value="2">Закрыт</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Изменить задачу</button>
                        </div>
                    </form>

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

<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script> -->
<script src="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.js') }}"></script>

<script src="{{ asset('assets/admin/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>

<script>
    $(function() {
        $('.select2').select2();
    });

    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#reservationdate2').datetimepicker({
        format: 'L'
    });
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo',
                ]
            },
            language: 'ru',
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
        })
        .catch(function(error) {
            console.error(error);
        });
</script>

@endsection