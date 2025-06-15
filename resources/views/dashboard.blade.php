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

<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    {{-- ⚡ messaggi flash --}}
    @foreach (['success','error'] as $msg)
        @if(session($msg))
            <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }}">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach


    {{-- 🔒 SOLO admin/revisori: riepilogo veicoli --}}
    @if(auth()->user()->is_admin)
        <h3>🚗 Veicoli inseriti</h3>
        <ul>
            @foreach($vehicles as $v)
                <li>{{ $v->brand }} {{ $v->model }} – €{{ $v->price }}</li>
            @endforeach
        </ul>
        <hr>
    @endif


    {{-- 📅 Riepilogo prenotazioni – visibile a **tutti** i loggati --}}
    <h3>📅 Le tue prenotazioni</h3>

    @if($bookings->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Data</th>
                <th>Orario</th>
                <th>Veicolo / Pagamento</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $b)
                <tr>
                    <td>{{ $b->date }}</td>
                    <td>{{ $b->start_time }}-{{ $b->end_time }}</td>
                    <td>
                        {{ $b->vehicle->brand }} {{ $b->vehicle->model }}

                        @if(!$b->is_paid)
                            {{-- 🔘 Bottone Paga --}}
                            <form action="{{ route('bookings.pay',$b) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Paga</button>
                            </form>
                        @else
                            <span class="badge bg-success">Pagato</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Nessuna prenotazione trovata.</p>
    @endif
</div>

<!-- Chatbot Box -->
    <div class="card mt-5">
        <div class="card-header">🤖 Chatbot Assistenza</div>
        <div class="card-body">
            <div id="chat-box" class="border p-3 mb-3" style="height:200px; overflow-y:auto; background:#f9f9f9;"></div>
            <form id="chat-form">
                <div class="input-group">
                    <input type="text" id="user-input" class="form-control" placeholder="Scrivi una domanda..." required>
                    <button class="btn btn-primary" type="submit">Invia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('chat-form').addEventListener('submit', function(e){
    e.preventDefault();
    const input = document.getElementById('user-input');
    const message = input.value;
    if(!message.trim()) return;

    const chatBox = document.getElementById('chat-box');
    chatBox.innerHTML += `<div><strong>Tu:</strong> ${message}</div>`;

    // Simulazione risposta bot
    let response = 'Mi dispiace, non ho capito la domanda.';

    if (message.toLowerCase().includes('prenotazione')) response = 'Per prenotare un veicolo, vai su “Cerca veicoli” e clicca su Prenota.';
    if (message.toLowerCase().includes('orari')) response = 'Il servizio è attivo 24/7.';
    if (message.toLowerCase().includes('ciao')) response = 'Ciao! Come posso aiutarti oggi?';
    if (message.toLowerCase().includes('auto disponibili')) response = 'Puoi visualizzare tutte le auto disponibili dalla Home.';

    chatBox.innerHTML += `<div><strong>Bot:</strong> ${response}</div>`;
    chatBox.scrollTop = chatBox.scrollHeight;
    input.value = '';
});
</script>
</div>

@endsection
