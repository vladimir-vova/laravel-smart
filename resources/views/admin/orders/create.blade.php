@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Новый заказ</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title">Новый заказ</h3>
                    </div>
                    <!-- /.card-header -->

                    <form role="form" method="post" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="condition">Состояние</label>
                                <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition">
                                    @foreach($condition as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                    @foreach($type as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direction">Направление</label>
                                <select class="form-control @error('direction') is-invalid @enderror" id="direction" name="direction">
                                    @foreach($direction as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start">Старт</label>
                                <select class="form-control @error('start') is-invalid @enderror" id="start" name="start">
                                    @foreach($start as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Сообщение</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Сообщение..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Создать</button>
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