<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Vehicle;
use App\Models\Booking;

class PaymentController extends Controller
{
    /**
     * Avvia la sessione di pagamento Stripe e reindirizza l’utente
     * alla pagina di checkout.
     *
     * @param  \App\Models\Vehicle  $vehicle  (route-model binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout(Vehicle $vehicle)
    {
        // Recupera la prenotazione NON pagata dell’utente loggato
        $booking = auth()->user()->bookings()
            ->where('vehicle_id', $vehicle->id)
            ->where('is_paid', false)
            ->latest()
            ->firstOrFail();   // 404 se non trovata

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'product_data' => [
                        'name' => 'Prenotazione: ' . $vehicle->brand . ' ' . $vehicle->model,
                    ],
                    // Stripe usa i centesimi: 1 € = 100
                    'unit_amount'  => $vehicle->price_per_hour * 100,
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            // Passiamo l’ID prenotazione per marcarla “pagata” al ritorno
            'success_url' => route('payment.success', ['booking' => $booking->id]),
            'cancel_url'  => route('payment.cancel',  ['booking' => $booking->id]),
        ]);

        return redirect($session->url);
    }

    /**
     * Pagamento riuscito: marca la prenotazione come pagata.
     */
    public function success(Request $request)
    {
        $bookingId = $request->query('booking');

        // L’utente deve essere il proprietario della prenotazione
        $booking = auth()->user()->bookings()->findOrFail($bookingId);

        $booking->is_paid = true;
        $booking->save();

        return view('payments.success');
    }

    /**
     * Pagamento annullato.
     */
    public function cancel()
    {
        return view('payments.cancel');
    }
}
