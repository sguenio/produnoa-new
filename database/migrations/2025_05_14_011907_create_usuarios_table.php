// database/migrations/xxxx_xx_xx_xxxxxx_create_usuarios_table.php
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
            $table->string('password'); // Nombre de columna corregido
            $table->timestamps(); // Añade created_at y updated_at
            $table->softDeletes(); // Añade deleted_at para borrado suave
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
