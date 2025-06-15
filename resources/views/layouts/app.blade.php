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

</body>
</html>
