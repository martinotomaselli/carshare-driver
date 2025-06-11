<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = \App\Models\Vehicle::all(); 
    return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'seats' => 'nullable|integer|min:1',
        'price_per_hour' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ]);

    \App\Models\Vehicle::create($validated);

    return redirect()->route('vehicles.index')->with('success', 'Veicolo aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'price_per_day' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ]);
        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Veicolo aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Vehicle  $vehicle  Il veicolo da eliminare
     * @return \Illuminate\Http\RedirectResponse
     */ 
    
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Veicolo eliminato con successo!');
    }
}
