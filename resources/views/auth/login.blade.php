@extends('layouts.app')

@section('content')
<div class="container col-md-4">
    <h2 class="mb-4 text-center">Accedi</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required autofocus>
            @error('email') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Ricordami</label>
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3">
        Non hai un account?
        <a href="{{ route('register') }}">Registrati</a>
    </p>
</div>
@endsection
