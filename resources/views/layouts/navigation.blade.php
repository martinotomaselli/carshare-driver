<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarShare</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">CarShare</a>

        <ul class="navbar-nav ms-auto">
            {{-- Utente loggato --}}
            @auth
                {{-- Saluto --}}
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">Ciao, {{ Auth::user()->name }}</a>
                </li>

                {{-- Link visibili a TUTTI gli utenti loggati --}}
                <li class="nav-item"><a class="nav-link" href="{{ route('vehicles.index') }}">Cerca veicoli</a></li>
                <li class="nav-item"><a class="nav-link bg-danger" href="{{ route('user.dashboard') }}">Le tue prenotazioni</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviewer.request') }}">Diventa revisore</a></li>

                {{-- Area ADMIN / REVISORE --}}
                @if(Auth::user()->is_admin)
                    <li class="nav-item"><span class="badge bg-success">Revisore</span></li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.vehicles.create') }}">Aggiungi veicolo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.panel') }}">Pannello</a>
                    </li>
                @endif

                {{-- Logout --}}
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="nav-link btn btn-link p-0">Logout</button>
                    </form>
                </li>
            @else
                {{-- Utente guest --}}
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrati</a></li>
            @endauth
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>
</body>
</html>
