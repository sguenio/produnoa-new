<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use App\Models\Remito;

class RemitoSeeder extends Seeder
{
    public function run(): void
    {
        $proveedorIds = Proveedor::pluck('id')->toArray();

        if (empty($proveedorIds)) {
            $this->command->warn('No se encontraron proveedores para ejecutar el RemitoSeeder. Saltando...');
            return;
        }

        $remitos = [
            ['codigo_remito' => 'R-005847', 'fecha_recepcion' => '2025-07-10', 'observaciones' => 'Entrega parcial. Faltan 2 bultos.'],
            ['codigo_remito' => 'R-005912', 'fecha_recepcion' => '2025-07-11', 'observaciones' => null],
            ['codigo_remito' => 'A-001-00345', 'fecha_recepcion' => '2025-07-11', 'observaciones' => 'Se verificó la cadena de frío. Todo OK.'],
            ['codigo_remito' => 'B-2025-459', 'fecha_recepcion' => '2025-07-12', 'observaciones' => null],
            ['codigo_remito' => 'R-006003', 'fecha_recepcion' => '2025-07-12', 'observaciones' => 'Entrega completa.'],
            ['codigo_remito' => 'FAC-002-1239', 'fecha_recepcion' => '2025-07-13', 'observaciones' => null],
            ['codigo_remito' => 'R-006115', 'fecha_recepcion' => '2025-07-13', 'observaciones' => null],
            ['codigo_remito' => 'R-006130', 'fecha_recepcion' => '2025-07-14', 'observaciones' => 'El transportista llegó fuera del horario pactado.'], // <-- OBSERVACIÓN MOVIDA AQUÍ
            ['codigo_remito' => 'C-2025-07-01', 'fecha_recepcion' => '2025-07-14', 'observaciones' => null],
            ['codigo_remito' => 'R-006201', 'fecha_recepcion' => '2025-07-15', 'observaciones' => 'Se recibió fuera de horario.'],
            ['codigo_remito' => 'R-006205', 'fecha_recepcion' => '2025-07-15', 'observaciones' => null],
            ['codigo_remito' => 'D-004-8812', 'fecha_recepcion' => '2025-07-16', 'observaciones' => 'Documentación adjunta correcta.'],
        ];

        foreach ($remitos as $remito) {
            Remito::create([
                'proveedor_id' => $proveedorIds[array_rand($proveedorIds)],
                'codigo_remito' => $remito['codigo_remito'],
                'fecha_recepcion' => $remito['fecha_recepcion'],
                'observaciones' => $remito['observaciones'],
            ]);
        }
    }
}
