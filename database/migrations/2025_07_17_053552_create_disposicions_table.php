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
        Schema::create('disposiciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lote_id')->constrained('lotes');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->enum('tipo_disposicion', ['Devolución a Proveedor', 'Destrucción']);
            $table->text('motivo');
            $table->dateTime('fecha_disposicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposicions');
    }
};
