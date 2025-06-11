<form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
    @csrf
    @method('PUT')
    <!-- Compila i valori esistenti -->
    <input type="text" name="brand" value="{{ old('brand', $vehicle->brand) }}" />
    <!-- ... -->
</form>
