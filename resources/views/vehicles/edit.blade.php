
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-4">Modifica Veicolo</h1>
            <form method="POST" action="{{ route('admin.vehicles.update', $vehicle->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="brand" class="block text-sm font-medium text-gray-700">Marca</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $vehicle->brand) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <!-- Aggiungi altri campi qui -->
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Aggiorna Veicolo</button>
            </form>
        </div>
    </div>
@endsection


