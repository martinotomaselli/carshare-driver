<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('brand');              // Marca del veicolo (es. Fiat)
        $table->string('model');              // Modello (es. Panda)
        $table->string('type');               // Tipo (auto, scooter, bici)
        $table->integer('seats')->nullable(); // Numero posti (se auto)
        $table->decimal('price_per_hour', 6, 2); // Prezzo orario
        $table->string('image')->nullable();  // Percorso immagine (es. 'uploads/panda.jpg')
        $table->text('description')->nullable(); // Descrizione opzionale
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
