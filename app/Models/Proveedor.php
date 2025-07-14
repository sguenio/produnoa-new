<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream
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

=======
use Illuminate\Database\Eloquent\SoftDeletes; // Importar SoftDeletes

class Proveedor extends Model
{
    use HasFactory, SoftDeletes; // Usar SoftDeletes

    /**
     * El nombre de la tabla asociada con el modelo.
     * Es buena práctica especificarlo si el nombre no sigue la convención en inglés.
     */
    protected $table = 'proveedores';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
>>>>>>> Stashed changes
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
<<<<<<< Updated upstream
=======
        'info_adicional',
>>>>>>> Stashed changes
    ];
}
