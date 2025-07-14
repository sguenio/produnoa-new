<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor; // Importamos el modelo

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores = [
            'FLAIR',
            'SAPORITI',
            'GIVAUDAN',
            'EL BAHIENSE',
            'INGRECOR',
            'JUSTO',
            'IFF',
            'NOVAROM',
            'CAVOUR',
            'TUTEUR',
            'VITRAFOS',
        ];

        foreach ($proveedores as $nombre) {
            Proveedor::create([
                'nombre' => $nombre,
                'telefono' => '0385-4' . rand(100000, 999999), // Teléfono ficticio
                'email' => strtolower(str_replace(' ', '', $nombre)) . '@ejemplo.com', // Email ficticio
                'direccion' => 'Calle Falsa 123, Ciudad', // Dirección ficticia
                'info_adicional' => 'Información de contacto y CUIT.', // Info ficticia
            ]);
        }
    }
}
