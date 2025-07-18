<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * El nombre de la tabla asociada con el modelo.
     */
    protected $table = 'proveedores';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
        'info_adicional',
    ];
}
