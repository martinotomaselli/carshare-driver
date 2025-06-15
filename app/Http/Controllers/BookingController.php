<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /*========================
      FORM PRENOTAZIONE
    ========================*/
    public function create(Vehicle $vehicle)
    {
        // Mostra il form “Prenota” per il veicolo selezionato
        return view('bookings.create', compact('vehicle'));
    }

    /*========================
      SALVATAGGIO PRENOTAZIONE
    ========================*/
    public function store(Request $r, Vehicle $vehicle)
    {
        $data = $r->validate([
            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time',
        ]);

        // associa utente ↔ veicolo
        $r->user()->bookings()->create(array_merge($data, [
        'vehicle_id' => $vehicle->id,
        ]));

        return redirect()
                ->route('user.dashboard')
                ->with('success', 'Prenotazione effettuata con successo!');
    }

    /*========================
      CHECK DISPONIBILITÀ
      (lasciato volutamente vuoto, se in futuro ti serve)
    ========================*/
    public function check(Request $request) {}


    /*========================
      PAGAMENTO PRENOTAZIONE
    ========================*/
    public function pay(Booking $booking)
    {
        // controllo sicurezza
        if (auth()->id() !== $booking->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $booking->is_paid = true;
        $booking->save();

        // resoconto: in base alla differenza oraria e al prezzo orario
        $hours = now()->parse($booking->end_time)->diffInMinutes(now()->parse($booking->start_time)) / 60;
        $price = $booking->vehicle->price_per_hour * $hours;

        return redirect()
            ->route('user.dashboard')
            ->with('success', "Pagamento effettuato con successo per il veicolo {$booking->vehicle->brand} {$booking->vehicle->model} (Totale: €" . number_format($price, 2) . ")");
    }


    /*========================
      MODIFICA PRENOTAZIONE
    ========================*/
    public function edit(Booking $booking)
    {
        // Solo l’utente proprietario (o un admin) può modificare
        if (auth()->id() !== $booking->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $r, Booking $booking)
    {
        if (auth()->id() !== $booking->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $data = $r->validate([
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        $booking->update($data);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Prenotazione aggiornata!');
    }

    public function destroy(Booking $booking)
    {
        if (auth()->id() !== $booking->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $booking->delete();

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Prenotazione eliminata.');
    }


}
