@extends('layouts.layout')

@section('header')

@endsection

@include('layouts.errors')

@section('content')

<div class="card container">
    <div class="card-body">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name='password' required>
            </div>
            <button type="submit" class="btn btn-primary">Авторизоваться</button>
            <a href="{{ route('index') }}" class="btn btn-danger">Главная</a>
        </form>
    </div>
</div>

@endsection