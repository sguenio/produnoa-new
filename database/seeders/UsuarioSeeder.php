<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usamos el modelo para crear, es una mejor práctica
        // y nos aseguramos de que las contraseñas se encripten automáticamente
        // gracias a la configuración del 'cast' en el modelo.
        \App\Models\Usuario::create([
            'nombre' => 'Admin General',
            'email' => 'admin@produnoa.com',
            'rol' => 'Administrador', // 'rol' en minúscula
            'password' => '12345678', // Laravel lo encriptará automáticamente
        ]);

        \App\Models\Usuario::create([
            'nombre' => 'Operario de Prueba',
            'email' => 'operario@produnoa.com',
            'rol' => 'Operario', // 'rol' en minúscula
            'password' => '12345678',
        ]);
    }
}
