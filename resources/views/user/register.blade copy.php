@extends('layouts.layout')

@section('header')

@endsection

@include('layouts.errors')

@section('content')

<div class="card container">
    <div class="card-body">
        <form action="{{ route('create.users') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name='password' required>
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Подтверждение пароля</label>
                <input type="password" class="form-control" id="password2" name='password_confirmation' required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            <a href="{{ route('index') }}" class="btn btn-danger">Главная</a>
        </form>
    </div>
</div>

@endsection