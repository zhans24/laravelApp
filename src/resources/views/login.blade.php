@extends('auth')
@vite('resources/js/auth.js')

@section('form')
    <h1 class="text-center mb-4">Вход</h1>
    <div class="card p-4 mx-auto" style="max-width: 400px;">
        <form method="POST" id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Введите email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>
    </div>
@endsection
