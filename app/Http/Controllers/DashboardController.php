<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $bookings = $request->user()
                            ->bookings()
                            ->with('vehicle')
                            ->orderByDesc('created_at')
                            ->get();

        return view('user.dashboard', compact('bookings'));
    }
}
