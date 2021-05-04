<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminPanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">

    @yield('style')

</head>

<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" data-enable-remember="true" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('contact.create') }}" class="nav-link">Contact</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('logout') }}" class="nav-link">Выход</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <!-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                        </a>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" target="_blank" class="brand-link">
                <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">На сайт</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="{{ route('profile.index') }}" class="text-capitalize d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item border-bottom">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Главная</p>
                            </a>
                        </li>
                        @if(auth()->user()->status->title != 'Клиент')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Задачи
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tasks.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Открытые задачи</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tasks.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новая задача</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Закрытые задачи</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('message.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-envelope"></i>
                                <p>
                                    Сообщения
                                    <span class="badge badge-info right">{{ $message }}</span>
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->status->title == 'Администратор' || auth()->user()->status->title == 'Зам. администратора')
                        <li class="nav-item has-treeview border-top">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-check-square"></i>
                                <p>
                                    Статусы
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('status.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список статусов</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('status.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новый статус</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Пользователи
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список пользователей</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новый пользователь</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview border-top">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-check-square"></i>
                                <p>
                                    Статусы заказов
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('works.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список ст. заказов</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('works.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новый ст. заказов</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @endif

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>
                                    Заказы
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список заказов</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новый заказ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Закрытые заказы</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>
                                    Категории
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список категорий</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новая категория</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Теги
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список тегов</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новый тег</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Статьи
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Список статей</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Новая статья</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper @yield('class')">

            <div class="container mt-2">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.1
            </div>
            <!-- <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

    @yield('script')

    <script>
        $('.nav-sidebar a').each(function() {
            let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
            let link = this.href;
            if (link == location) {
                $(this).addClass('active');
                $(this).closest('.has-treeview').addClass('menu-open');
            }
        });

        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>

</body>

</html>