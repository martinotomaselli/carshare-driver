@extends('layouts.app')

@section('title', 'Riepilogo prenotazione')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Riepilogo prenotazione</h2>

    {{-- $vehicle passato dal controller --}}
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $vehicle->model }}</h4>
            <p class="card-text">Prezzo: €{{ number_format($vehicle->price_per_day, 2, ',', '.') }} / giorno</p>
            <p class="card-text">Data prenotazione: {{ $date }}</p>

            <form action="{{ route('payment.checkout') }}" method="GET">
                @csrf
                {{-- puoi passare parametri nascosti se servono --}}
                <button class="btn btn-success">Procedi al pagamento con Stripe</button>
            </form>
        </div>
    </div>
</div>
@endsection