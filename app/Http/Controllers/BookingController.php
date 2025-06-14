<?php
namespace App\Http\Controllers;
use App\Models\{Vehicle,Booking};use Illuminate\Http\Request;
class BookingController extends Controller
{
    public function create(Vehicle $vehicle){return view('bookings.create',compact('vehicle'));}

    public function store(Request $r,Vehicle $vehicle){ $data=$r->validate(['date'=>'required|date','start_time'=>'required','end_time'=>'required|after:start_time']); $r->user()->bookings()->create(array_merge($data,['vehicle_id'=>$vehicle->id])); return to_route('dashboard')->with('success','Prenotazione effettuata'); }
    
    public function check(Request $r){}
}