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
        Schema::create('parametros_analisis', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->unique();

            // Relación con la tabla de unidades. Puede ser nulo.
            $table->foreignId('unidad_id')->nullable()->constrained('unidades')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametro_analises');
    }
};
