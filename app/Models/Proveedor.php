<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * El nombre de la tabla asociada con el modelo.
     * Laravel intentaría buscar 'proveedors' (plural en inglés),
     * así que especificamos el nombre correcto 'proveedores'.
     */
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
    ];
}
