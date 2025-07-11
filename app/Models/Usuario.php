<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Especificamos el nombre de la tabla porque no sigue la convención de Laravel (users).
     */
    protected $table = 'usuarios';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'Nombre',
        'Apellido',
        'Rol',
        'Email',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse en las serializaciones (al convertir a JSON).
     */
    protected $hidden = [
        'password',
    ];
}
