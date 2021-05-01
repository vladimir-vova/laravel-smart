@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Заказы</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
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
                        <h3 class="card-title">Список заказов</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Добавить
                            заказ</a>
                        @if (count($orders))
                        <!-- <div class="col-sm-12 col-md-6 mb-3">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button>
                                <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button>
                                <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button>
                                <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button>
                            </div>
                        </div> -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        @if(Auth::user()->status_id == 2 || Auth::user()->status_id == 3)
                                        <th>Кто работает</th>
                                        @else
                                        <th>Состояние</th>
                                        <th>Тип</th>
                                        @endif
                                        <th>Статус</th><!-- ожидание, выполнен -->
                                        <th>Направление</th>
                                        <th>Старт</th>
                                        <th>Описание</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>

                                        @if(Auth::user()->status_id == 2 || Auth::user()->status_id == 3)

                                        <!-- Кто работает -->
                                        @if($item->user_id == 0)
                                        <td>Свободен</td>
                                        @else
                                        <td>{{ $item->user->name }}</td>
                                        @endif

                                        @else

                                        <td>{{ $item->condition }}</td>
                                        <td>{{ $item->type }}</td>

                                        @endif

                                        <!-- Статус заказа -->
                                        <td>{{ $item->work->title }}</td>
                                        <td>{{ $item->direction }}</td>
                                        <td>{{ $item->start }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ route('orders.edit',['order'=>$item->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <form action="{{ route('orders.destroy',['order'=>$item->id]) }}" method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>Заказов пока нет...</p>
                        @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $orders->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
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