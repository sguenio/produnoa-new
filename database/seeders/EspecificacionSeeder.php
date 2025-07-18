<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\ParametroAnalisis;
use App\Models\Especificacion;

class EspecificacionSeeder extends Seeder
{
    public function run(): void
    {
        // Usamos un array asociativo para definir las especificaciones completas
        $plantillas = [
            'SABORIZANTES' => [
                ['nombre' => 'Densidad', 'min' => 1.0100, 'max' => 1.1500],
                ['nombre' => 'pH', 'min' => 2.5, 'max' => 4.5],
                ['nombre' => 'Color', 'texto' => 'Característico'],
                ['nombre' => 'Turbidez', 'texto' => 'Límpido'],
                ['nombre' => 'Sabor', 'texto' => 'Característico'],
            ],
            'ACIDULANTES' => [
                ['nombre' => 'Apariencia', 'texto' => 'Polvo cristalino blanco'],
                ['nombre' => 'Sabor en Solución', 'texto' => 'Ácido, característico'],
                ['nombre' => 'pH', 'min' => 2.0, 'max' => 2.8],
                ['nombre' => 'Pureza', 'min' => 99.5, 'max' => 100.5],
                ['nombre' => 'Densidad', 'min' => 1.5000, 'max' => 1.7000],
            ],
            'COLORANTES' => [
                ['nombre' => 'Densidad', 'min' => 1.1000, 'max' => 1.3000],
                ['nombre' => 'Apariencia al 2%', 'texto' => 'Líquido homogéneo'],
                ['nombre' => 'Aroma', 'texto' => 'Característico'],
                ['nombre' => 'Sabor', 'texto' => 'Característico'],
                ['nombre' => 'pH', 'min' => 4.0, 'max' => 6.0],
            ],
            'EDULCORANTES' => [
                ['nombre' => 'Apariencia', 'texto' => 'Polvo blanco'],
                ['nombre' => 'Solubilidad', 'texto' => 'Completa en agua'],
                ['nombre' => 'Sabor', 'texto' => 'Dulce, sin residual'],
                ['nombre' => 'pH', 'min' => 5.0, 'max' => 7.0],
            ],
            'JUGOS' => [
                ['nombre' => 'Densidad', 'min' => 1.0400, 'max' => 1.0600],
                ['nombre' => 'Brix', 'min' => 10.0, 'max' => 12.5],
                ['nombre' => 'Acidez', 'min' => 0.5, 'max' => 1.0],
                ['nombre' => 'Brix Corregidos', 'min' => 10.0, 'max' => 12.0],
                ['nombre' => 'SO2', 'max' => 10], // Solo valor máximo
                ['nombre' => 'Sabor', 'texto' => 'Característico, sin sabores extraños'],
                ['nombre' => 'Color', 'texto' => 'Característico'],
            ],
            'OTROS' => [
                ['nombre' => 'pH', 'min' => 6.0, 'max' => 8.0],
                ['nombre' => 'Apariencia', 'texto' => 'Según estándar'],
                ['nombre' => 'Densidad', 'min' => 0.900, 'max' => 1.200],
                ['nombre' => 'Claridad', 'texto' => 'Transparente'],
                ['nombre' => 'Solubilidad', 'texto' => 'Completa'],
                ['nombre' => 'Aroma', 'texto' => 'Característico'],
            ],
        ];

        foreach ($plantillas as $nombreCategoria => $parametros) {
            $categoria = Categoria::where('nombre', $nombreCategoria)->first();

            if ($categoria) {
                foreach ($parametros as $paramData) {
                    $parametro = ParametroAnalisis::where('nombre', $paramData['nombre'])->first();

                    if ($parametro) {
                        // Usamos updateOrCreate para crear la especificación o actualizarla si ya existe
                        Especificacion::updateOrCreate(
                            [
                                'categoria_id' => $categoria->id,
                                'parametro_id' => $parametro->id,
                            ],
                            [
                                'valor_minimo' => $paramData['min'] ?? null,
                                'valor_maximo' => $paramData['max'] ?? null,
                                'valor_texto' => $paramData['texto'] ?? null,
                            ]
                        );
                    }
                }
            }
        }
        $this->command->info('Seeder de especificaciones con valores completado exitosamente.');
    }
}
