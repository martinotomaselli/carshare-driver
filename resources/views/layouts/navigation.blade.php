<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">CarShare</a>

    <div class="d-flex">
      @auth
    <li class="nav-item">
        <a class="nav-link" href="#">Ciao, {{ Auth::user()->name }}</a>
    </li>

    @if(Auth::user()->is_admin)
        <li class="nav-item">
            <span class="badge bg-success">Revisore</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.vehicles.create') }}">Aggiungi Veicolo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('panel') }}">Pannello Revisione</a>
        </li>
    @endif

    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link btn btn-link" type="submit">Logout</button>
        </form>
    </li>
@endauth

        
    </div>
  </div>
</nav>