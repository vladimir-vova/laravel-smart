@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Новый статус заказов</h1>
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
                        <h3 class="card-title">Новый статус заказа</h3>
                    </div>
                    <!-- /.card-header -->

                    <form role="form" method="post" action="{{ route('works.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Название">
                            </div>
                            <div class="form-group">
                                <label for="color">Цвет</label>
                                <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                                    <option value="bg-primary">Синий</option>
                                    <option value="bg-secondary">Серый</option>
                                    <option value="bg-success">Зеленый</option>
                                    <option value="bg-danger">Красный</option>
                                    <option value="bg-warning">Оранжевый</option>
                                    <option value="bg-info">Голубой</option>
                                    <option value="bg-light">Светлый</option>
                                    <option value="bg-dark">Черный</option>
                                </select>
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