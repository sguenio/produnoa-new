<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Remito;
use App\Models\Producto;
use App\Models\Unidad;
use App\Models\Lote;
use Illuminate\Support\Str;

class LoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $remitos = Remito::all();
        $productos = Producto::all();
        $unidadKg = Unidad::where('abreviatura', 'Kg')->first();
        $unidadL = Unidad::where('abreviatura', 'L')->first();

        if ($remitos->isEmpty() || $productos->isEmpty() || !$unidadKg || !$unidadL) {
            $this->command->warn('No se encontraron suficientes datos (remitos, productos o unidades) para ejecutar el LoteSeeder. Saltando...');
            return;
        }

        // LISTA DE OBSERVACIONES MÁS COMPLETA Y REALISTA
        $observacionesComunes = [
            'Un bulto presenta una leve rotura en el embalaje secundario.',
            'Muestra enviada a laboratorio para análisis prioritario.',
            'Se verificó la cadena de frío. Termógrafo marca 4°C. Todo OK.',
            'Documentación incompleta. Falta Certificado de Análisis (CoA) del proveedor.',
            'El número de lote en la etiqueta no coincide con el del remito. Se deja asentado.',
            'El pallet llegó en mal estado, se re-palletizó en depósito para asegurar estabilidad.',
            'Producto presenta aglutinamiento/grumos. Notificado a Jefe de Calidad.',
            'Color del producto ligeramente más oscuro de lo habitual. Requiere análisis de colorimetría.',
            'Se recepcionan 10 de 12 bultos. Quedan 2 bultos pendientes de entrega.',
            'Aprobado por Jefatura para uso de emergencia en producción.',
            'Envase primario (bolsa interna) se encuentra intacto. Se acepta con precaución.',
            'Fecha de vencimiento muy próxima. Notificar a planificación.',
        ];

        $lotesACrear = 120;
        $this->command->info("Creando {$lotesACrear} lotes de prueba...");

        for ($i = 0; $i < $lotesACrear; $i++) {
            $remitoActual = $remitos->random();
            $productoActual = $productos->random();
            $fechaElaboracion = $remitoActual->fecha_recepcion->subDays(rand(15, 60));
            $fechaVencimiento = $fechaElaboracion->copy()->addMonths(rand(12, 24));

            Lote::create([
                'remito_id' => $remitoActual->id,
                'producto_id' => $productoActual->id,
                'lote_proveedor_codigo' => strtoupper($productoActual->codigo_interno . '-' . Str::random(4)),
                'cantidad_recibida' => rand(5000, 20000) / 100,
                'unidad_id' => in_array($productoActual->categoria->nombre, ['JUGOS', 'ACEITES']) ? $unidadL->id : $unidadKg->id,
                'fecha_elaboracion' => $fechaElaboracion,
                'fecha_vencimiento' => $fechaVencimiento,
                'estado' => ['En Cuarentena', 'Rechazado', 'Listo para Producción', 'Listo para Producción'][array_rand(['En Cuarentena', 'Rechazado', 'Listo para Producción', 'Listo para Producción'])],
                'observaciones' => (rand(1, 4) == 1) ? $observacionesComunes[array_rand($observacionesComunes)] : null,
            ]);
        }

        $this->command->info("¡Seeder de Lotes completado!");
    }
}
