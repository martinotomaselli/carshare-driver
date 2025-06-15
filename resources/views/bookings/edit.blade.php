@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px">
    <h3 class="mb-4">Modifica prenotazione</h3>

    {{-- errori di validazione --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking) }}" method="POST">
        @csrf @method('PATCH')

        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date"
                   name="date"
                   value="{{ old('date', $booking->date->format('Y-m-d')) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label class="form-label">Ora inizio</label>
                <input type="time"
                       name="start_time"
                       value="{{ old('start_time', $booking->start_time) }}"
                       class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Ora fine</label>
                <input type="time"
                       name="end_time"
                       value="{{ old('end_time', $booking->end_time) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Annulla</a>
            <button class="btn btn-primary">Salva</button>
        </div>
    </form>
</div>
@endsection
