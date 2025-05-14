<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'ID_Usuario';
    protected $fillable = ['Nombre', 'Apellido', 'Rol', 'Email', 'Contraseña'];
    public $timestamps = true;
}

