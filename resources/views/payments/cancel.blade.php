@extends('layouts.app')

@section('title', 'Pagamento annullato')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-warning display-5">❌ Pagamento annullato</h1>
    <p class="lead mt-3">
        Nessun addebito è stato effettuato.<br>
        Puoi tornare al catalogo veicoli e riprovare quando vuoi.
    </p>

    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-4">
        Torna ai veicoli
    </a>
</div>
@endsection
