@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Cerca Veicoli Disponibili</h2>

    <form method="GET" action="{{ route('bookings.check') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="date" class="form-label">Data</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ $filters['date'] ?? '' }}" required>
        </div>

        <div class="col-md-4">
            <label for="start_time" class="form-label">Ora Inizio</label>
            <input type="time" id="start_time" name="start_time" class="form-control" value="{{ $filters['start_time'] ?? '' }}" required>
        </div>

        <div class="col-md-4">
            <label for="end_time" class="form-label">Ora Fine</label>
            <input type="time" id="end_time" name="end_time" class="form-control" value="{{ $filters['end_time'] ?? '' }}" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cerca</button>
        </div>
    </form>

    @if(isset($vehicles) && count($vehicles))
        <h4 class="mt-4">Veicoli disponibili:</h4>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Marca</th>
                    <th>Modello</th>
                    <th>Tipo</th>
                    <th>Posti</th>
                    <th>Prezzo/h</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>{{ $vehicle->seats }}</td>
                        <td>€ {{ number_format($vehicle->price_per_hour, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request()->filled('date'))
        <p class="text-muted mt-3">Nessun veicolo disponibile per la fascia oraria selezionata.</p>
    @endif
</div>
@endsection
