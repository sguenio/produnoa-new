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
        Schema::create('analisis_resultados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analisis_id')->constrained('analisis')->onDelete('cascade');
            $table->foreignId('parametro_id')->constrained('parametros_analisis');
            $table->string('valor_resultado');
            $table->boolean('aprueba');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_resultados');
    }
};
