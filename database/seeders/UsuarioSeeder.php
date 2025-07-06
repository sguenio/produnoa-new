<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Importante para encriptar contraseñas

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario Administrador
        DB::table('usuarios')->insert([
            'Nombre' => 'Admin',
            'Apellido' => 'Produnoa',
            'Rol' => 'Administrador',
            'Email' => 'admin@produnoa.com',
            'password' => Hash::make('12345678'), // Encripta la contraseña
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear usuario Operario
        DB::table('usuarios')->insert([
            'Nombre' => 'Operario',
            'Apellido' => 'Produnoa',
            'Rol' => 'Operario',
            'Email' => 'operario@produnoa.com',
            'password' => Hash::make('12345678'), // Encripta la contraseña
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
