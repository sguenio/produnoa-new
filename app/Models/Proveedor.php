<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Importa HasMany
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
        'info_adicional',
    ];

    /**
     * Define la relación: Un Proveedor tiene muchos Remitos.
     * ESTA ES LA FUNCIÓN QUE FALTABA
     */
    public function remitos(): HasMany
    {
        return $this->hasMany(Remito::class);
    }
}
