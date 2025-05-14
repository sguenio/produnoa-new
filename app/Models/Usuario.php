<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // Usar la tabla correcta
    protected $fillable = ['Nombre', 'Apellido', 'Rol', 'Email', 'password'];
    protected $hidden = ['password'];
}
