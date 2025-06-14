{{-- Estende il layout principale --}}
@extends('layouts.app')

{{-- Contenuto della pagina --}}
@section('content')
<div class="container">
    <h1 class="mb-4">Aggiungi un nuovo veicolo</h1>

    {{-- Mostra errori di validazione --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> {{-- Stampa ogni errore --}}
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form per creare un nuovo veicolo --}}
    <form action="{{ route('admin.vehicles.store') }}" method="POST">
        @csrf 

        {{-- Marca --}}
        <div class="mb-3">
            <label for="brand" class="form-label">Marca</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        {{-- Modello --}}
        <div class="mb-3">
            <label for="model" class="form-label">Modello</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        {{-- Tipo --}}
        <div class="mb-3">
            <label for="type" class="form-label">Tipo (es. auto, bici...)</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        {{-- Posti --}}
        <div class="mb-3">
            <label for="seats" class="form-label">Numero di posti</label>
            <input type="number" name="seats" class="form-control">
        </div>

        {{-- Prezzo orario --}}
        <div class="mb-3">
            <label for="price_per_hour" class="form-label">Prezzo orario (€)</label>
            <input type="number" name="price_per_hour" step="0.01" class="form-control" required>
        </div>

        {{-- Descrizione (opzionale) --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        {{-- Pulsante per inviare --}}
        <button type="submit" class="btn btn-primary">Salva veicolo</button>
    </form>
</div>
@endsection
