{{-- resources/views/vehicles/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    {{-- pulsante “Aggiungi veicolo” solo per admin/revisori --}}
    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ route('admin.vehicles.create') }}"
               class="btn btn-success mb-4">+ Aggiungi veicolo</a>
        @endif
    @endauth

    <h1 class="mb-4">Catalogo veicoli</h1>

    <div class="row g-3">
        @foreach ($cars as $car)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-capitalize">
                            {{ $car->brand }} {{ $car->model }}
                        </h5>

                        <p class="card-text mb-4">
                            € {{ number_format($car->price_per_hour, 2, ',', '.') }} <small>/ giorno</small>
                        </p>

                        {{-- pulsanti in fondo alla card --}}
                        <div class="mt-auto">
                            <a href="{{ route('vehicles.book', $car) }}"
                               class="btn btn-primary mb-1">Prenota</a>

                            @auth
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.vehicles.edit', $car) }}"
                                       class="btn btn-warning mb-1">Modifica</a>

                                    <form action="{{ route('admin.vehicles.destroy', $car) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mb-1"
                                                onclick="return confirm('Sei sicuro di voler eliminare questo veicolo?')">
                                            Elimina
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- paginazione --}}
    <div class="mt-4">
        {{ $cars->links() }}
    </div>
</div>
@endsection
