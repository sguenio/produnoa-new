<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\ParametroAnalisis;
use App\Models\Especificacion;

class EspecificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mapeo de Categorías a los Parámetros que necesitan, basado en tu Excel.
        $plantillas = [
            'SABORIZANTES' => ['Densidad', 'pH', 'Color', 'Turbidez', 'Sabor'],
            'ACIDULANTES' => ['Apariencia', 'Sabor en Solución', 'pH', 'Pureza', 'Densidad'],
            'COLORANTES' => ['Densidad', 'Apariencia al 2%', 'Aroma', 'Sabor', 'pH'],
            'EDULCORANTES' => ['Apariencia', 'Solubilidad', 'Sabor', 'pH'],
            'JUGOS' => ['Densidad', 'Brix', 'Acidez', 'Brix Corregidos', 'SO2', 'Sabor', 'Color'],
            'OTROS' => ['pH', 'Apariencia', 'Densidad', 'Claridad', 'Solubilidad', 'Aroma'],
        ];

        // Iteramos sobre cada plantilla definida
        foreach ($plantillas as $nombreCategoria => $parametrosNombres) {
            // Buscamos la categoría en la base de datos
            $categoria = Categoria::where('nombre', $nombreCategoria)->first();

            if ($categoria) {
                $this->command->info("Asignando parámetros para la categoría: {$categoria->nombre}");

                // Iteramos sobre la lista de nombres de parámetros para esta categoría
                foreach ($parametrosNombres as $parametroNombre) {
                    // Buscamos el parámetro por su nombre
                    $parametro = ParametroAnalisis::where('nombre', $parametroNombre)->first();

                    if ($parametro) {
                        // Si ambos existen, creamos la especificación (el enlace)
                        Especificacion::firstOrCreate([
                            'categoria_id' => $categoria->id,
                            'parametro_id' => $parametro->id,
                        ]);
                        $this->command->line("  -> Parámetro '{$parametroNombre}' asignado.");
                    } else {
                        $this->command->error("  -> ADVERTENCIA: No se encontró el parámetro '{$parametroNombre}' en la base de datos.");
                    }
                }
            } else {
                $this->command->error("ADVERTENCIA: No se encontró la categoría '{$nombreCategoria}' en la base de datos.");
            }
        }
    }
}
