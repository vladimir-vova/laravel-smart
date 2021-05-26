@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Задача</h1>
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
                        <h3 class="card-title">{{ $task->work->title }}</h3>
                        <div class="card-tools">
                            @if($task->user_id == Auth::user()->id || Auth::user()->status_id==1 || Auth::user()->status_id==2)
                            <a href="{{ route('tasks.edit',['task'=>$task->id]) }}" class="btn btn-tool">
                                <i class="fas fa-pen text-dark"></i>
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <dl>
                            <dt>Название</dt>
                            <dd>{{ $task->name }}</dd>
                            <dt>Описание</dt>
                            <dd>{!! $task->description !!}</dd>
                            <dt>Дата</dt>
                            <dd>{{ $task->getPostDate('created_at') }}-{{ $task->getPostDate('updated_at') }}</dd>
                        </dl>
                        <form action="{{ route('updateToClose',['task'=>$task->id]) }}" method="post" class="float-left">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Закрыть сделку?')">
                                <!-- <i class="fas fa-arrow-circle-right"></i> -->
                                Закрыть
                            </button>
                        </form>
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