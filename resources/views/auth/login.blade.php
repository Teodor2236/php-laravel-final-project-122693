@extends('layouts.app')

@section('content')
<div class="container-register">
    <h2 class="text-center">Вход в системата</h2>
    <p class="text-center text-muted">Моля, въведете вашите данни за достъп</p>
    <hr>

    <form method="POST" action="{{ route('user.login') }}" autocomplete="off">
        @csrf
        
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success') }}
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="email" class="form-label"><b>Имейл адрес</b></label>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="email" 
                   class="form-control" 
                   name="email" 
                   id="email" 
                   value="{{ old('email') }}" 
                   placeholder="Въведете вашия имейл"
                   autocomplete="username"
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label"><b>Парола</b></label>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" 
                   class="form-control" 
                   name="password" 
                   id="password" 
                   placeholder="Въведете вашата парола"
                   autocomplete="current-password"
                   required>
        </div>

        <hr>

        <div class="form-group d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Нямате акаунт? 
                <a href="{{ route('register') }}">Регистрация</a>
            </p>
            <button type="submit" class="btn btn-primary">Вход</button>
        </div>
    </form>
</div>
@endsection 