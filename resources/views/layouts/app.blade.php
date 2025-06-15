<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarShare</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">CarShare</a>

        <ul class="navbar-nav ms-auto">
            @auth
                <!-- nome + badge -->
                <li class="nav-item me-3">
                    {{ Auth::user()->name }}
                    @if(Auth::user()->is_admin)
                        <span class="badge bg-success">Revisore</span>
                    @endif
                </li>

                <!-- visibile a TUTTI i loggati -->
                <li class="nav-item">
                    <!-- <a class="nav-link" href="/">Cerca veicoli</a> -->
                    <a class="nav-link" href="{{ route('vehicles.index') }}">Cerca veicoli</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">
                     Le tue prenotazioni
                    </a>
                </li>

                @if(!Auth::user()->is_admin)
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('reviewer.request') }}">Diventa revisore</a>
                    </li>
                @endif




                <!-- SOLO ad admin/revisori -->
               @auth
                   @if(Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.vehicles.create') }}">Aggiungi veicolo</a>
                    </li>
                     @endif
                @endauth
               
                @if(Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.panel') }}">Pannello</a>
                    </li>
                @endif
                
                
               

                <!-- logout -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            @else
                <!-- guest -->
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrati</a></li>
            @endauth
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<footer class="bg-light py-3 text-center">
    © {{ date('Y') }} CarShare
</footer>

{{-- Chat floating button + box --------------------------------------------------}}
<style>
#chat-bubble      { position:fixed; bottom:20px; right:20px; z-index:9999; }
#chat-box         { position:fixed; bottom:90px; right:20px; width:320px; height:340px;
                    background:#fff; border:1px solid #ddd; border-radius:8px;
                    display:none; flex-direction:column; }
#chat-box header  { background:#0d6efd; color:#fff; padding:8px 12px; font-weight:600; }
#chat-box main    { flex:1; padding:10px; overflow-y:auto; font-size:.9rem; }
#chat-box footer  { display:flex; border-top:1px solid #ddd; }
#chat-box input   { flex:1; border:none; padding:8px; }
#chat-box button  { border:none; width:70px; background:#0d6efd; color:#fff; }
</style>

<button id="chat-bubble" class="btn btn-primary rounded-circle">
    💬
</button>

<div id="chat-box" class="shadow">
    <header>Assistente</header>
    <main id="chat-log"></main>
    <footer>
        <input id="chat-input" placeholder="Scrivi qui…">
        <button id="chat-send">Invia</button>
    </footer>
</div>

<script>
document.getElementById('chat-bubble').onclick = () =>
    document.getElementById('chat-box').style.display =
        document.getElementById('chat-box').style.display === 'flex' ? 'none' : 'flex';

document.getElementById('chat-send').onclick = sendChat;
document.getElementById('chat-input').addEventListener('keydown', e=>{
    if(e.key==='Enter') sendChat();
});

function append(role, text) {
    const div = document.createElement('div');
    div.innerHTML = `<strong>${role}:</strong> ${text}`;
    document.getElementById('chat-log').appendChild(div);
    document.getElementById('chat-log').scrollTop = 999999;
}

function sendChat() {
    const input = document.getElementById('chat-input');
    const msg   = input.value.trim();
    if(!msg) return;
    append('Tu', msg);
    input.value='';

    fetch('{{ route('chatbot.message') }}', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body:JSON.stringify({message:msg})
    })
    .then(r=>r.json()).then(d=>append('Bot', d.reply))
    .catch(()=>append('Bot','Errore di rete :('));
}
</script>

</body>
</html>
