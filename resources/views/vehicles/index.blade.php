@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Catalogo veicoli</h1>

    {{-- “Aggiungi veicolo” solo per admin --}}
    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success mb-3">
                + Aggiungi veicolo
            </a>
        @endif
    @endauth

    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                        <p class="card-text">€ {{ $car->price }}/giorno</p>

                        {{-- prenotazione SOLO se loggato --}}
                        @auth
                            <a href="{{ route('vehicles.book', $car) }}" class="btn btn-primary">
                                Prenota
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $cars->links() }}
</div>
@endsection
