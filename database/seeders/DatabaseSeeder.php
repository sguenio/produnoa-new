<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Llama al seeder de usuarios que acabamos de crear
        $this->call([
            UsuarioSeeder::class,
            ProveedorSeeder::class,
            CategoriaSeeder::class,
            UnidadSeeder::class,
            ProductoSeeder::class,
            ParametroAnalisisSeeder::class,
            EspecificacionSeeder::class,
            RemitoSeeder::class,
            LoteSeeder::class,
        ]);
    }
}
