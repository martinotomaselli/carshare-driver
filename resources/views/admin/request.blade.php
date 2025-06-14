@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Richiedi accesso come Revisore</h2>
        <p class="mb-3">Compila il modulo per inviare una richiesta e diventare revisore.</p>

        <form action="{{ route('reviewer.send') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Invia Richiesta</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
