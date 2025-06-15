<?php

namespace App\Http\Controllers;

use App\Mail\ReviewerRequestMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AdminRequestController extends Controller
{
    // Mostra il form "Diventa revisore"
    public function requestForm()
    {
        return view('admin.request');
    }

    // Invia l'email con i link firmati per approvazione o rifiuto
    public function sendRequest(Request $request)
    {
        $user = $request->user();

        $approveUrl = URL::temporarySignedRoute(
            'admin.approve',
            now()->addMinutes(60),
            ['user' => $user->id]
        );

        $rejectUrl = URL::temporarySignedRoute(
            'admin.reject',
            now()->addMinutes(60),
            ['user' => $user->id]
        );

        Mail::to('admin@example.com')->send(
            new ReviewerRequestMail($user, $approveUrl, $rejectUrl)
        );

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Richiesta inviata con successo! Attendi approvazione.');
    }

    // Approvazione della richiesta → assegna ruolo di revisore
    public function approve(Request $request, User $user)
    {
        $user->is_admin = true;
        $user->save();

        return redirect()
            ->route('vehicles.index')
            ->with('success', "{$user->name} ora è un revisore!");
    }

    // Rifiuta la richiesta (puoi loggare o inviare email di notifica)
    public function reject(Request $request, User $user)
    {
        return redirect()
            ->route('vehicles.index')
            ->with('error', "Richiesta di {$user->name} rifiutata.");
    }

    // Pannello di gestione richieste
    public function panel()
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.panel', compact('users'));
    }
}
