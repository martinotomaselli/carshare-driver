<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function __invoke(Request $request)
    {
        // logica del bot (mock)
        $question = strtolower($request->input('message'));

        $answer = 'Mi dispiace, non ho capito.';
        if (str_contains($question, 'prenotazione')) {
            $answer = 'Per prenotare vai su “Cerca veicoli”, scegli l’auto e fai clic su Prenota.';
        } elseif (str_contains($question, 'orari')) {
            $answer = 'Il servizio è attivo 24/7.';
        }

        return response()->json(['reply' => $answer]);
    }
}
