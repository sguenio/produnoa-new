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
    // database/seeders/UsuarioSeeder.php
    public function run(): void
    {
        \App\Models\Usuario::create([
            'nombre' => 'Admin',
            'apellido' => 'General', // <-- AÑADIR
            'email' => 'admin@produnoa.com',
            'rol' => 'Administrador',
            'password' => '12345678',
        ]);
        \App\Models\Usuario::create([
            'nombre' => 'Operario',
            'apellido' => 'Prueba', // <-- AÑADIR
            'email' => 'operario@produnoa.com',
            'rol' => 'Operario',
            'password' => '12345678',
        ]);
    }
}
