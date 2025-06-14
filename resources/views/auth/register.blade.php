@extends('layouts.app')

@section('content')
<div class="container col-md-4">
    <h2 class="mb-4 text-center">Registrati</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input id="name" type="text" name="name" class="form-control" required autofocus>
            @error('name') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required>
            @error('email') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Conferma Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Registrati</button>
    </form>

    <p class="text-center mt-3">
        Hai già un account?
        <a href="{{ route('login') }}">Login</a>
    </p>
</div>
@endsection
