<?php
namespace App\Http\Controllers;
use App\Models\Vehicle;use Illuminate\Http\Request;
class VehicleController extends Controller{
    public function index(){ $cars=Vehicle::paginate(6); return view('vehicles.index',compact('cars')); }
    
    public function create()
    { 
        return view('vehicles.create'); 
    }
    public function store(Request $r){ $data=$r->validate(['brand'=>'required','model'=>'required','price'=>'required|numeric']); Vehicle::create($data); return to_route('vehicles.index')->with('success','Veicolo inserito'); }
    public function edit(Vehicle $vehicle){ return view('vehicles.edit',compact('vehicle')); }
    public function update(Request $r,Vehicle $vehicle){ $vehicle->update($r->validate(['brand'=>'required','model'=>'required','price'=>'required|numeric'])); return back()->with('success','Aggiornato'); }
    public function destroy(Vehicle $vehicle){ $vehicle->delete(); return back()->with('error','Veicolo eliminato'); }
}