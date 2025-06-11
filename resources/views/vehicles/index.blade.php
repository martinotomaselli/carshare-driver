{{-- Estende il layout principale (layouts/app.blade.php) --}}
@extends('layouts.app')

{{-- Sezione del contenuto principale della pagina --}}
@section('content')
<div class="container">
    
    {{-- Titolo della pagina --}}
    <h1 class="mb-4">Tutti i veicoli</h1>

    {{-- Pulsante per andare al form di creazione veicolo --}}
    <a href="{{ route('vehicles.create') }}" class="btn btn-success mb-3">Aggiungi Veicolo</a>

    {{-- Tabella con l'elenco dei veicoli --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>         {{-- Colonna: marca del veicolo (es. Fiat) --}}
                <th>Modello</th>       {{-- Colonna: modello (es. Panda) --}}
                <th>Tipo</th>          {{-- Colonna: tipo (auto, bici, scooter) --}}
                <th>Posti</th>         {{-- Colonna: numero di posti --}}
                <th>Prezzo/h</th>      {{-- Colonna: prezzo per ora --}}
                <th>Azioni</th>        {{-- Colonna: pulsanti modifica/elimina --}}
            </tr>
        </thead>
        <tbody>
            {{-- Ciclo su tutti i veicoli passati dal controller --}}
            @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->brand }}</td>       {{-- Stampa marca --}}
                <td>{{ $vehicle->model }}</td>       {{-- Stampa modello --}}
                <td>{{ $vehicle->type }}</td>        {{-- Stampa tipo --}}
                <td>{{ $vehicle->seats }}</td>       {{-- Stampa numero posti --}}
                <td>€ {{ number_format($vehicle->price_per_hour, 2, ',', '.') }}</td> {{-- Prezzo orario formattato in euro --}}
                <td>
                    {{-- Link per modificare il veicolo --}}
                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">Modifica</a>

                    {{-- Form per eliminare il veicolo (metodo DELETE) --}}
                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                        @csrf   {{-- Token di protezione Laravel --}}
                        @method('DELETE')  {{-- Metodo HTTP DELETE --}}
                        <button class="btn btn-danger btn-sm">Elimina</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
