// database/migrations/xxxx_xx_xx_xxxxxx_create_usuarios_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Renombra la clase para seguir la convención de Laravel
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
            $table->string('password', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
