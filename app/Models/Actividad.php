<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'usuario_id',
        'tipo_accion',
        'descripcion',
        'ip_address',
    ];

    // Definimos la relación: Un registro de actividad pertenece a un Usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
