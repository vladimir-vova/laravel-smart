@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список статусов заказа</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Works</li>
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
                        <h3 class="card-title">Список статусов заказа</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('works.create') }}" class="btn btn-primary mb-3">Добавить
                            статус заказа</a>
                        @if (count($works))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">Номер</th>
                                        <th>Название</th>
                                        <th>Шаг</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($works as $item)
                                    <tr>
                                        <td>{{ $item->step }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if($item->step != $works->count())
                                            <a href="{{ route('works.step',['way'=>'up','name'=>$item->title,'step'=>$item->step]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fa fa-caret-up" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($item->step != 1)
                                            <a href="{{ route('works.step',['way'=>'down','name'=>$item->title,'step'=>$item->step]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('works.edit',['work'=>$item->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <form action="{{ route('works.destroy',['work'=>$item->id]) }}" method="post" class="float-left">
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
                        <p>Список статусов пока нет...</p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $works->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
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