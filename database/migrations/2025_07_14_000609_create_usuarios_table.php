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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Sin apellido según tu nuevo SQL
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('rol', ['Operario', 'Administrador'])->default('Operario');
            $table->timestamp('email_verified_at')->nullable(); // Recomendado por Laravel
            $table->rememberToken(); // Recomendado por Laravel
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
