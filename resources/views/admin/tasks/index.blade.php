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
    <div class="container-fluid h-100">
        @foreach($works as $item)
        <div class="card card-row {{ $item->color }}">
            <div class="card-header">
                <h3 class="card-title text-white">
                    {{ $item->title }}
                </h3>
            </div>
            <div class="card-body text-dark">
                <!-- <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Создать</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link text-dark">#2342</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                            <label for="customCheckbox1" class="custom-control-label">Bug</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                            <label for="customCheckbox2" class="custom-control-label">Feature</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                            <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                            <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                            <label for="customCheckbox5" class="custom-control-label">Examples</label>
                        </div>
                    </div>
                </div> -->
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