<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 100);
            $table->string('Apellido', 100);
            $table->enum('Rol', ['Administrador', 'Operario']);
            $table->string('Email', 50)->unique();
            $table->string('Contraseña', 255);
            $table->timestamps(); // Incluye timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
