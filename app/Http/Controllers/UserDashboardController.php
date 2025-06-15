<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // prepara i dati della dashboard utente
        $bookings = $request->user()->bookings()->with('vehicle')->get();
        return view('user.dashboard', compact('bookings'));
    }
}
