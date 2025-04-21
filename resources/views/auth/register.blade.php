@extends('layouts.app')

@section('content')
<div class="container-register">
    <h2 class="text-center">Регистрация</h2>
    <p class="text-center text-muted">Създайте своя акаунт за достъп до системата</p>
    <hr>

    <form method="POST" action="{{ route('user.register') }}" autocomplete="off">
        @csrf

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success') }}
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="name" class="form-label"><b>Име</b></label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" 
                   class="form-control" 
                   name="name" 
                   id="name" 
                   value="{{ old('name') }}" 
                   placeholder="Въведете вашето име"
                   autocomplete="name"
                   required>
        </div>

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
                   placeholder="Въведете парола"
                   autocomplete="new-password"
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label"><b>Потвърждение на паролата</b></label>
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" 
                   class="form-control" 
                   name="password_confirmation" 
                   id="password_confirmation" 
                   placeholder="Повторете паролата"
                   autocomplete="new-password"
                   required>
        </div>

        <p class="text-muted small">
            Създавайки акаунт се съгласявате с нашите 
            <a href="#">Условия за ползване</a> и 
            <a href="#">Политика за поверителност</a>.
        </p>

        <hr>

        <div class="form-group d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Вече имате акаунт? 
                <a href="{{ route('login') }}">Вход</a>
            </p>
            <button type="submit" class="btn btn-primary">Регистрация</button>
        </div>
    </form>
</div>
@endsection 