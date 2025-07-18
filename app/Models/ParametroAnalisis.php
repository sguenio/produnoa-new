<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParametroAnalisis extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'parametros_analisis';

    protected $fillable = [
        'nombre',
        'unidad_id',
    ];

    /**
     * Define la relación: Un Parámetro pertenece a una Unidad (opcionalmente).
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }
}
