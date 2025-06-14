@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center" style="min-height:70vh;">
    <h1 class="display-3 fw-bold mb-4">CarShare</h1>

    <div class="d-flex gap-3">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Registrati</a>
    </div>
</div>
@endsection