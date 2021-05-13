@extends('admin.layouts.layout')

@section('style')

<style>
    .ul-one {
        list-style: none;
        border-bottom: 2px solid gray;
        padding-bottom: 50px;
    }

    .ul-one a {
        color: black;
    }

    .ul-one>li {
        font-size: 32px;
    }

    .ul-one>ul>li {
        font-size: 20px;
    }

    .live {
        border-bottom: 2px solid black;
    }

    .live div {
        margin-bottom: 100px;
    }

    .live h1 {
        margin-bottom: 50px;
    }

    .live h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .live p {
        margin: 25px 0;
        font-size: 16px;
    }

    .live span {
        font-weight: bold;
    }
</style>

<!-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}"> -->

@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Правила работы с задачами</h1>
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

<section class="content">
    <div class="container-fluid">
        <!-- <br> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Правила работы с задачами</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="ul-one">
                            <li><a href="#live">Жизненный цикл</a></li>
                            <ul>
                                <li>В ожидании</li>
                                <li>В работе</li>
                                <li>Code review</li>
                                <li>Корректировки</li>
                                <li>Тестирование</li>
                                <li>Выполненая</li>
                                <li>Закрытая</li>
                            </ul>
                            <li><a href="#type">Типы задач</a></li>
                            <ul>
                                <li>Обычная</li>
                                <li>Срочная</li>
                            </ul>
                        </ul>
                        <div class='live'>
                            <h1 id='live'>Жизненный цикл</h1>
                            <div>
                                <h2>В ожидании выполнения</h2>
                                <p>
                                    <span>Описание:</span> Согласованная и детализированная задача поступает разработчику на данный этап.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Получены доступы. Проект развёрнут на .loc. Задача понятна и есть первоначальный роадмап для её выполнения
                                </p>
                            </div>
                            <div>
                                <h2>В работе</h2>
                                <p>
                                    <span>Описание:</span> Этап для задач, над которыми разработчик работает прямо сейчас.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Поставленная задача выполнена и протестирована разработчиком на работоспособность
                                </p>
                            </div>
                            <div>
                                <h2>Code Review</h2>
                                <p>
                                    <span>Описание:</span> На этом этапе код, написанный одним разработчиком, проверяется другим, чтобы избежать возможных ошибок перед тем, как отправить его на боевые сайты.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Прохождение проверки качества кода, отсутствие конфликтов
                                </p>
                            </div>
                            <div>
                                <h2>Корректировки</h2>
                                <p>
                                    <span>Описание:</span> Задачи, в которых нужно что-то доработать. Возможно, во время проведения Code Review была обнаружена ошибка, или она обнаружилась уже при тестировании.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Прохождение проверки качества кода, отсутствие конфликтов
                                </p>
                            </div>
                            <div>
                                <h2>Тестирование</h2>
                                <p>
                                    <span>Описание:</span> Этап для задач, загружаемых на dev-версии проектов.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Отсутствие конфликтов
                                </p>
                            </div>
                            <div>
                                <h2>Выполненая</h2>
                                <p>
                                    <span>Описание:</span> Задача переводится на этот этап после внутреннего тестирования и ожидает подтверждения от клиента.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> Результат работы принят клиентом.
                                </p>
                            </div>
                            <div>
                                <h2>Закрытая</h2>
                                <p>
                                    <span>Описание:</span> Завершённые задачи. На данном этапе находятся задачи, которые были проверены и соответствуют поставленным условиям. Такие задачи считаются закрытыми.
                                </p>
                                <p>
                                    <span>Условие перехода на следующий этап:</span> С данного этапа задачи не могут вернуться обратно в процесс.
                                </p>
                            </div>
                        </div>
                        <div class='live'>
                            <h1 id='type'>Типы задач</h1>
                            <div>
                                <h2>Обычная</h2>
                                <p>У данного типа нет никаких преимуществ или приоритетов, по сравнению с другими задачами</p>
                            </div>
                            <div>
                                <h2>Срочная</h2>
                                <p>У этого типа задач стоит приоритет над всеми остальными, их нужно делать в первую очередь.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('script')

<!-- <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script> -->

@endsection