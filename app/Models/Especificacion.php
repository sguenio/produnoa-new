<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Especificacion extends Model
{
    use HasFactory, LogsActivity;

    // Le decimos a Eloquent que esta tabla no sigue la convención de pluralización
    protected $table = 'categorias_parametros_especificaciones';

    protected $fillable = [
        'categoria_id',
        'parametro_id',
        'valor_minimo',
        'valor_maximo',
        'valor_texto',
    ];

    // Definimos la relación: una especificación pertenece a una Categoría
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // Definimos la relación: una especificación pertenece a un Parámetro
    public function parametro(): BelongsTo
    {
        return $this->belongsTo(ParametroAnalisis::class, 'parametro_id');
    }
}
