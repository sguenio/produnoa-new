<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = [
            ['nombre' => 'Kilogramo', 'abreviatura' => 'Kg'],
            ['nombre' => 'Gramo', 'abreviatura' => 'g'],
            ['nombre' => 'Litro', 'abreviatura' => 'L'],
            ['nombre' => 'Mililitro', 'abreviatura' => 'ml'],
            ['nombre' => 'Unidad', 'abreviatura' => 'Un'],
            ['nombre' => 'Metro', 'abreviatura' => 'm'],
            ['nombre' => 'Centímetro', 'abreviatura' => 'cm'],
            ['nombre' => 'Tonelada', 'abreviatura' => 't'],
            ['nombre' => 'Porcentaje', 'abreviatura' => '%'],
            ['nombre' => 'Partes Por Millón', 'abreviatura' => 'PPM'],
        ];

        foreach ($unidades as $unidad) {
            // Usamos firstOrCreate para evitar duplicados si el seeder se ejecuta varias veces
            Unidad::firstOrCreate(['abreviatura' => $unidad['abreviatura']], $unidad);
        }
    }
}
