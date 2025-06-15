<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Mostra tutti i veicoli
    public function index()
    {
        $cars = Vehicle::paginate(6);
        return view('vehicles.index', compact('cars'));
    }

    // Mostra il form per creare un nuovo veicolo
    public function create()
    {
        return view('vehicles.create');
    }

    // Salva un nuovo veicolo
    public function store(Request $request)
    {
        $data = $request->validate([
            'brand'           => 'required|string|max:50',
            'model'           => 'required|string|max:50',
            'type'            => 'required|string|max:30',
            'seats'           => 'required|integer|min:1',
            'price_per_hour'  => 'required|numeric|min:0',
            'description'     => 'nullable|string',
        ]);

        Vehicle::create($data);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Veicolo inserito con successo!');
    }

    // Mostra il form per modificare un veicolo esistente
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Aggiorna un veicolo esistente
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'brand'           => 'required|string|max:50',
            'model'           => 'required|string|max:50',
            'type'            => 'required|string|max:30',
            'seats'           => 'required|integer|min:1',
            'price_per_hour'  => 'required|numeric|min:0,1',
            'description'     => 'nullable|string',
        ]);

        $vehicle->update($data);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Veicolo aggiornato con successo!');
    }

    // Elimina un veicolo
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return back()->with('error', 'Veicolo eliminato');
    }
}
