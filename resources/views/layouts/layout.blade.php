<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo2.png') }}">

    @yield('style')

    <title>@section('title') SmartLab @show</title>
</head>

<body>


    @section('header')
    <div class="menu container-fluid position-relative">
        <div class="row position-fixed">
            <div class="col-xl-3 col">Future&CO</div>
            <div class="col"></div>
            <div class="col-xl-6 col">
                <ul>
                    <li><a href="#obzor">ПРОЦЕСС РАБОТЫ</a></li>
                    <li><a href="#osobennosti">КЕЙСЫ</a></li>
                    <li><a href="#price">Стоимость</a></li>
                    <li><a href="#otzuv">ОТЗЫВЫ</a></li>
                    <li><a href="#download">СТОИМОСТЬ</a></li>
                </ul>
            </div>
        </div>
    </div>
    @show

    @yield('content')

    <script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @yield('script')

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->
</body>

</html>