@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Gestione Richieste Revisore</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($users->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.approve', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approva Revisore</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nessun utente in attesa di approvazione.</p>
    @endif
</div>
@endsection
