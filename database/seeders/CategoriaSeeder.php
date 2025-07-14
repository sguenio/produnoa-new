<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'SABORES',
            'ACIDULANTES',
            'COLORANTES',
            'EDULCORANTES',
            'JUGOS',
            'OTROS',
        ];

        foreach ($categorias as $nombre) {
            // Usamos firstOrCreate para evitar duplicados si el seeder se ejecuta varias veces
            Categoria::firstOrCreate(['nombre' => strtoupper($nombre)]);
        }
    }
}
