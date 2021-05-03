@extends('admin.layouts.layout')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <h4>Данные</h4>
            <hr>
            <form class="form-horizontal" action="{{ route('profile.data') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name" name='name' value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name='email' value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                    <div class="col-sm-10">
                        <p>{{ Auth::user()->status->title }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Изменить</button>
                    </div>
                </div>
            </form>
            <h4 class="mt-5">Изменить пароль</h4>
            <hr>
            <form class="form-horizontal" action="{{ route('profile.password') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Новый пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Новый пароль" name='password'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password2" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password2" placeholder="Confirm Password" name='password_confirmation'>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Изменить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection