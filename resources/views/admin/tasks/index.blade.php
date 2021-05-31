@extends('admin.layouts.layout')

@section('style')


<link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">

@endsection

@section('class')
kanban
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Задачи</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content pb-3">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Добавить
        задачу</a>
    <a href="{{ route('rules') }}" class="text-danger">Как работать с задачами</a>
    <div class="container-fluid h-100">
        @foreach($works as $item)
        <div class="card card-row {{ $item->color }}">
            <div class="card-header">
                <h3 class="card-title text-white">
                    {{ $item->title }}
                </h3>
            </div>
            <div class="card-body text-dark">
                @foreach($tasks as $task)
                @if($task->work_id == $item->id &&
                (Auth::user()->status_id == 1 || Auth::user()->status_id == 2 || in_array(Auth::user()->id, $task->user->pluck('id')->all())))
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title"><a href="{{ route('tasks.show',['task'=>$task->id]) }}">{{ $task->name }}</a></h5>
                        <div class="card-tools">
                            <a href="{{ route('tasks.show',['task'=>$task->id]) }}" class="btn btn-tool btn-link text-dark">#{{ $task->id }}</a>
                            @if($task->user_id == Auth::user()->id || Auth::user()->status_id==1 || Auth::user()->status_id==2)
                            <a href="{{ route('tasks.edit',['task'=>$task->id]) }}" class="btn btn-tool">
                                <i class="fas fa-pen text-dark"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if($task->step == 0)
                        <p class='text-danger'><b>Важность:</b> Срочная</p>
                        @else
                        <p><b>Важность:</b> Обычная</p>
                        @endif
                        <p><b>Задача:</b> {{ $task->work->title }}</p>
                        <p><b>Задача от заказа:</b> {{ $task->order_id }}</p>
                        <p><b>Время выполнения:</b> {{ $task->getPostDate('created_at') }}-{{ $task->getPostDate('updated_at') }}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('script')

<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>

@endsection