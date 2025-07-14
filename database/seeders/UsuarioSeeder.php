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
    // database/seeders/UsuarioSeeder.php
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Admin General',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('password'), // Cambia 'password' por una contraseña segura
            'rol' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('usuarios')->insert([
            'nombre' => 'Operario de Prueba',
            'email' => 'operario@ejemplo.com',
            'password' => Hash::make('password'),
            'rol' => 'Operario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
