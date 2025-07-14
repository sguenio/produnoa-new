<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // El array de datos completo, limpio y organizado por categoría
        $data = [
            'SABORIZANTES' => [
                ['codigo_interno' => '60004', 'nombre' => 'Emulsión Naranja SC886295'],
                ['codigo_interno' => '60005', 'nombre' => 'Emulsión Limón LQ-765-871-9'],
                ['codigo_interno' => '60006', 'nombre' => 'Emulsión Multifruta JN-288-516-0'],
                ['codigo_interno' => '60022', 'nombre' => 'Esencia Pera FX 2318C'],
                ['codigo_interno' => '60023', 'nombre' => 'Esencia Pera 54373 CE'],
                ['codigo_interno' => '60024', 'nombre' => 'Esencia Manzana 502604 B'],
                ['codigo_interno' => '60025', 'nombre' => 'Sweetness Modulator SC604895'],
                ['codigo_interno' => '60026', 'nombre' => 'Bitter SC864322'],
                ['codigo_interno' => '60027', 'nombre' => 'Emulsión Cola XD-231-965-0'],
                ['codigo_interno' => '60031', 'nombre' => 'Amargo WU-318-238-4'],
                ['codigo_interno' => '60050', 'nombre' => 'Esencia Guaraná 7946H'],
                ['codigo_interno' => '60058', 'nombre' => 'Esencia Manzana AR010704'],
                ['codigo_interno' => '60059', 'nombre' => 'Esencia Pera AR010705'],
                ['codigo_interno' => '60163', 'nombre' => 'Bitter LQ 202013'],
                ['codigo_interno' => '60070', 'nombre' => 'Emulsión Pomelo BA 8078-78'],
                ['codigo_interno' => '60078', 'nombre' => 'Bittex'],
                ['codigo_interno' => '60091', 'nombre' => 'Esencia Banana SC745554'],
                ['codigo_interno' => '60093', 'nombre' => 'Esencia Guaraná SC723789'],
                ['codigo_interno' => '60104', 'nombre' => 'Emulsión Limón KT 441-329-0'],
                ['codigo_interno' => '60136', 'nombre' => 'Aromatizante Vainilla 2X LQ 1403'],
                ['codigo_interno' => '60141', 'nombre' => 'Esencia Tónica HK-242-575-0'],
                ['codigo_interno' => '60145', 'nombre' => 'Emulsión Pomelo SC 935818'],
                ['codigo_interno' => '60149', 'nombre' => 'Emulsión Cola SC941430'],
                ['codigo_interno' => '60153', 'nombre' => 'Esencia Cola Vainilla SC942145'],
                ['codigo_interno' => '60158', 'nombre' => 'Emulsión Cola BA 1715-78'],
                ['codigo_interno' => '60164', 'nombre' => 'Emulsión Naranja FX-2094'],
                ['codigo_interno' => '60166', 'nombre' => 'Esencia Lima Limón SC1087902'],
                ['codigo_interno' => '60171', 'nombre' => 'Emulsión Naranja SC 685012'],
                ['codigo_interno' => '60176', 'nombre' => 'Sweetgem 545526-1-T'],
                ['codigo_interno' => '60177', 'nombre' => 'Emulsión Cola IO-943-421-3'],
                ['codigo_interno' => '60179', 'nombre' => 'Emulsión Naranja SC1205529'],
                ['codigo_interno' => '60181', 'nombre' => 'Emulsión Naranja LK 613 - 78 / 2'],
                ['codigo_interno' => '60182', 'nombre' => 'Esencia Lima Limón 1784'],
                ['codigo_interno' => '60189', 'nombre' => 'Tonic Bitter SC1217514'],
                ['codigo_interno' => '60189-2', 'nombre' => 'Bitter Tonic SC 1217514'], // Duplicado resuelto
                ['codigo_interno' => '60190', 'nombre' => 'Fernet SC1217512'],
                ['codigo_interno' => '60190-2', 'nombre' => 'Emulsion Fernet SC 1217512'], // Duplicado resuelto
                ['codigo_interno' => '60193', 'nombre' => 'Emulsión Herbal LK-11919-E'],
                ['codigo_interno' => '60194', 'nombre' => 'Emulsión Cítrica SW-358'],
            ],
            'ACIDULANTES' => [
                ['codigo_interno' => '60051', 'nombre' => 'Ácido Láctico 85%'],
                ['codigo_interno' => '60071', 'nombre' => 'Ácido Fosfórico'],
                ['codigo_interno' => '60072', 'nombre' => 'Ácido Tartárico'],
                ['codigo_interno' => '60075', 'nombre' => 'Ácido Málico'],
                ['codigo_interno' => '60080', 'nombre' => 'Ácido Ascórbico'],
                ['codigo_interno' => '60083', 'nombre' => 'Citrato de Sodio'],
                ['codigo_interno' => '60084', 'nombre' => 'Ácido Cítrico'],
            ],
            'COLORANTES' => [
                ['codigo_interno' => '60060', 'nombre' => 'Colorante Amarillo Tartrazina'],
                ['codigo_interno' => '60079', 'nombre' => 'Colorante Caramelo 90F'],
                ['codigo_interno' => '60089', 'nombre' => 'Colorante Rojo Allura 40'],
                ['codigo_interno' => '60107', 'nombre' => 'Colorante Rojo Amaranto'],
                ['codigo_interno' => '60137', 'nombre' => 'Colorante Amarillo Ocaso'],
                ['codigo_interno' => '60173', 'nombre' => 'Colorante Caramelo D 400'],
                ['codigo_interno' => '60178', 'nombre' => 'Colorante Caramelo DFS'],
            ],
            'EDULCORANTES' => [
                ['codigo_interno' => '60052', 'nombre' => 'Acesulfame'],
                ['codigo_interno' => '60073', 'nombre' => 'Ciclamato de Sodio'],
                ['codigo_interno' => '60074', 'nombre' => 'Sacarina Sódica'],
                ['codigo_interno' => '60085', 'nombre' => 'Aspartame'],
                ['codigo_interno' => '60092', 'nombre' => 'Sucralosa'],
            ],
            'OTROS' => [
                ['codigo_interno' => '60040', 'nombre' => 'Sorbato de Potasio Granulado'],
                ['codigo_interno' => '60043', 'nombre' => 'EDTA'],
                ['codigo_interno' => '60082', 'nombre' => 'Benzoato de Sodio'],
                ['codigo_interno' => '60105', 'nombre' => 'Hexametafosfato'],
                ['codigo_interno' => '60114', 'nombre' => 'Eritorbato de Sodio'],
                ['codigo_interno' => '60143', 'nombre' => 'Sulfato de Quinina'],
                ['codigo_interno' => '60159', 'nombre' => 'Vitamina Premix P443 BB'],
                ['codigo_interno' => '60160', 'nombre' => 'Benzoato Alta Calidad HQ'],
                ['codigo_interno' => '60167', 'nombre' => 'Dimetril DMDC'],
            ],
            'JUGOS' => [
                ['codigo_interno' => '70001', 'nombre' => 'Jugo Concentrado de Manzana'],
                ['codigo_interno' => '70002', 'nombre' => 'Jugo Concentrado de Naranja'],
                ['codigo_interno' => '70003', 'nombre' => 'Pulpa de Durazno'],
                ['codigo_interno' => '70004', 'nombre' => 'Jugo Clarificado de Uva'],
            ],
        ];

        foreach ($data as $nombreCategoria => $productos) {
            $this->command->info("Procesando categoría: {$nombreCategoria}...");
            $categoria = Categoria::where('nombre', $nombreCategoria)->first();

            if (!$categoria) {
                $this->command->error("  -> ADVERTENCIA: No se encontró la categoría '{$nombreCategoria}'. Saltando sus productos.");
                continue;
            }

            foreach ($productos as $producto) {
                Producto::firstOrCreate(
                    ['codigo_interno' => $producto['codigo_interno']],
                    [
                        'nombre' => $producto['nombre'],
                        'categoria_id' => $categoria->id,
                    ]
                );
            }
            $this->command->line("  -> " . count($productos) . " productos procesados para {$nombreCategoria}.");
        }
    }
}
