@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tutti i veicoli</h1>

    <a href="{{ route('vehicles.create') }}" class="btn btn-success mb-3">+ Aggiungi Veicolo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Marca</th>
                <th>Modello</th>
                <th>Tipo</th>
                <th>Posti</th>
                <th>Prezzo/h</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->seats }}</td>
                    <td>€ {{ number_format($vehicle->price_per_hour, 2) }}</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">Modifica</a>

                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo veicolo?')">Elimina</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Nessun veicolo disponibile</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
