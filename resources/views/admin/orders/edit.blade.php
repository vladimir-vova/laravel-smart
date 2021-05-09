@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование заказа</h1>
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
                        <h3 class="card-title">
                            Заказ "{{ $orders->id }}".
                            @if($orders->user_id)
                            <span class='text-success'>Над заказом работаем "{{ $orders->user->name }}"</span>
                            @else
                            <span class='text-danger'>Заказ в ожидании</span>
                            @endif
                        </h3>
                    </div>
                    <!-- /.card-header -->

                    <form role="form" method="post" action="{{ route('orders.update', ['order' => $orders->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="condition">Состояние</label>
                                <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition">
                                    @foreach($condition as $item)
                                    <option value="{{ $item }}" @if($item==$orders->condition) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                    @foreach($type as $item)
                                    <option value="{{ $item }}" @if($item==$orders->type) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direction">Направление</label>
                                <select class="form-control @error('direction') is-invalid @enderror" id="direction" name="direction">
                                    @foreach($direction as $item)
                                    <option value="{{ $item }}" @if($item==$orders->direction) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start">Старт</label>
                                <select class="form-control @error('start') is-invalid @enderror" id="start" name="start">
                                    @foreach($start as $item)
                                    <option value="{{ $item }}" @if($item==$orders->start) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Сообщение</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Сообщение...">{{ $orders->description }}</textarea>
                            </div>
                            @if(Auth::user()->status_id == 2 || Auth::user()->status_id == 3)
                            <div class="form-group">
                                <label for="work_id">Статус проекта</label>
                                <select class="form-control @error('work_id') is-invalid @enderror" id="work_id" name="work_id">
                                    @foreach($work as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$orders->work_id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                    <!-- <option value="1">В ожидании</option> -->
                                    <!-- <option value="2">В работе</option>
                                    <option value="3">Тестирование</option>
                                    <option value="4">На проверке</option> -->
                                </select>
                            </div>
                            @if($coor->count())

                            <div class="form-group">
                                <label for="user_id">Кто будет делать?</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                    @foreach($coor as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$orders->user_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @else
                            Нет координатора. Наймите его скорее...
                            @endif

                            <div class="form-group">
                                <label for="open">Закрыть?</label>
                                <select class="form-control @error('open') is-invalid @enderror" id="open" name="open">
                                    <option value="1">Открыт</option>
                                    <option value="2">Закрыт</option>
                                </select>
                            </div>

                            @endif
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Изменить</button>
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