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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
            $table->string('tipo_accion'); // Ej: 'CREACIÓN', 'ACTUALIZACIÓN', 'LOGIN'
            $table->string('descripcion'); // Ej: "Creó el proveedor SAPORITI"
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividads');
    }
};
