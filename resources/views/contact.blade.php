@extends('layouts.layout')

@section('style')

<link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">

@endsection

@section('header')

@endsection

@section('content')
<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Contact</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="color: white;">
        <!-- Default box -->
        <div>
            <div class="row">
                <div class="col"></div>
                <div class="col-6 text-dark">
                    @include('layouts.errors')
                </div>
                <div class="col"></div>
            </div>
            <div class="card-body row">
                <div class="col-4 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <h2>Admin</h2>
                        <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                            Phone: +1 234 56789012
                        </p>
                    </div>
                </div>
                <div class="col-8">
                    <form action="{{ route('contact.message') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName" class="text-dark">Ваше имя</label>
                                <input type="text" id="inputName" class="form-control" name='name'>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="text-dark">E-Mail</label>
                                <input type="email" id="inputEmail" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="inputSubject" class="text-dark">Тема сайта</label>
                                <input type="text" id="inputSubject" class="form-control" name='subject'>
                            </div>
                            <div class="form-group">
                                <label for="inputMessage" class="text-dark">Сообщение</label>
                                <textarea id="inputMessage" class="form-control" rows="4" name='message'></textarea>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <input type="submit" class="btn btn-primary" value="Send message">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<!-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script> -->
@endsection