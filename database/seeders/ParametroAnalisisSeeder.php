<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;
use App\Models\ParametroAnalisis;

class ParametroAnalisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primero, buscamos los IDs de las unidades que vamos a necesitar
        $unidadPorcentaje = Unidad::where('abreviatura', '%')->first();
        $unidadPPM = Unidad::where('abreviatura', 'PPM')->first();

        $parametros = [
            // Parámetros sin unidad
            ['nombre' => 'pH', 'unidad_id' => null],
            ['nombre' => 'Color', 'unidad_id' => null],
            ['nombre' => 'Turbidez', 'unidad_id' => null],
            ['nombre' => 'Sabor', 'unidad_id' => null],
            ['nombre' => 'Apariencia', 'unidad_id' => null],
            ['nombre' => 'Sabor en Solución', 'unidad_id' => null],
            ['nombre' => 'Aroma', 'unidad_id' => null],
            ['nombre' => 'Apariencia al 2%', 'unidad_id' => null],
            ['nombre' => 'Solubilidad', 'unidad_id' => null],
            ['nombre' => 'Claridad', 'unidad_id' => null],
            ['nombre' => 'Brix', 'unidad_id' => null], // Brix no tiene una unidad estándar en nuestra tabla
            ['nombre' => 'Brix Corregidos', 'unidad_id' => null],

            // Parámetros con unidad
            ['nombre' => 'Densidad', 'unidad_id' => null], // La unidad puede variar, la dejamos opcional
            ['nombre' => 'Pureza', 'unidad_id' => $unidadPorcentaje?->id],
            ['nombre' => 'Acidez', 'unidad_id' => $unidadPorcentaje?->id],
            ['nombre' => 'SO2', 'unidad_id' => $unidadPPM?->id],
        ];

        foreach ($parametros as $parametro) {
            // Usamos firstOrCreate para no crear duplicados si el seeder se ejecuta de nuevo
            ParametroAnalisis::firstOrCreate(['nombre' => $parametro['nombre']], $parametro);
        }
    }
}
