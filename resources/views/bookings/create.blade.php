@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Prenota il veicolo: <strong>{{ $vehicle->brand }} {{ $vehicle->model }}</strong></h1>

    <form method="POST" action="{{ route('vehicles.book.store', $vehicle->id) }}">

        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Data della prenotazione</label>
            <input type="date" name="date" id="date" class="form-control" required value="{{ old('date') }}">
            @error('date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Ora di inizio</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required value="{{ old('start_time') }}">
            @error('start_time') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Ora di fine</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required value="{{ old('end_time') }}">
            @error('end_time') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Conferma Prenotazione</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Annulla</a>
    </form>
</div>
@endsection
