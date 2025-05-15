@extends('auth')
@vite('resources/js/auth.js')

@section('form')
    <h1 class="text-center mb-4">Регистрация</h1>
    <div class="card p-4 mx-auto" style="max-width: 400px;">
        <form method="POST" id="registerForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ваше имя" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Введите email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
        </form>
    </div>
@endsection
