<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    // Especificamos el nombre de la tabla para evitar que Laravel busque 'unidads'
    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
        'abreviatura',
    ];
}
