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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remito_id')->constrained('remitos');
            $table->foreignId('producto_id')->constrained('productos');
            $table->string('lote_proveedor_codigo');
            $table->decimal('cantidad_recibida', 10, 2);
            $table->foreignId('unidad_id')->constrained('unidades');
            $table->date('fecha_elaboracion')->nullable();
            $table->date('fecha_vencimiento');
            $table->enum('estado', ['En Cuarentena', 'Rechazado', 'Listo para Producción', 'Agotado'])->default('En Cuarentena');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
