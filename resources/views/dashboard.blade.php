@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h1>Dashboard</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if(auth()->user()->is_admin)
    <div class="alert alert-info">
      Sei un revisore. Puoi aggiungere, modificare e rimuovere veicoli.
    </div>
  @else
    <div class="alert alert-secondary">
      Sei un utente. Puoi prenotare veicoli.
    </div>
  @endif

  <!-- Altri contenuti personalizzati -->
</div>
@endsection
