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
        Schema::create('categorias_parametros_especificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('parametro_id')->constrained('parametros_analisis')->onDelete('cascade');
            $table->decimal('valor_minimo', 10, 4)->nullable();
            $table->decimal('valor_maximo', 10, 4)->nullable();
            $table->string('valor_texto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especificacions');
    }
};
