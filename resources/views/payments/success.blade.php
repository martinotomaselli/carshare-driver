@extends('layouts.app')

@section('title', 'Pagamento riuscito')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-success display-5">✅ Pagamento completato!</h1>
    <p class="lead mt-3">
        La tua prenotazione è stata confermata.<br>
        Puoi visualizzarla e gestirla dalla tua dashboard.
    </p>

    <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-4">
        Vai alla dashboard
    </a>
</div>
@endsection
