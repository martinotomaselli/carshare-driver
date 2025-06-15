@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Le tue prenotazioni</h3>

    {{-- messaggi flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Veicolo</th>
                    <th>Pagamento</th>
                </tr>
            </thead>
            @foreach($bookings as $b)
                <tr>
                    <td>{{ $b->date }}</td>
                    <td>{{ $b->start_time }} – {{ $b->end_time }}</td>
                    <td>{{ $b->vehicle->brand }} {{ $b->vehicle->model }}</td>
                    <td>
                        @if($b->is_paid)
                            <span class="badge bg-success">Pagato</span>
                        @else
                            <form action="{{ route('bookings.pay', $b) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success">Paga</button>
                            </form>
                        @endif

                        <a href="{{ route('bookings.edit', $b) }}" class="btn btn-sm btn-primary ms-1">
                            Modifica
                        </a>

                        <form action="{{ route('bookings.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Eliminare la prenotazione?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger ms-1">Elimina</button>
                        </form>
                    </td>
                </tr>
        @endforeach

            </tbody>
        </table>
    @else
        <p>Nessuna prenotazione trovata.</p>
    @endif
</div>
@endsection
