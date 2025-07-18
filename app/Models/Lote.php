<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lote extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'lotes';

    protected $fillable = [
        'remito_id',
        'producto_id',
        'lote_proveedor_codigo',
        'cantidad_recibida',
        'unidad_id',
        'fecha_elaboracion',
        'fecha_vencimiento',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_elaboracion' => 'date',
        'fecha_vencimiento' => 'date',
        'cantidad_recibida' => 'decimal:2',
    ];

    // --- RELACIONES ---

    // Un Lote pertenece a un Remito
    public function remito(): BelongsTo
    {
        return $this->belongsTo(Remito::class);
    }

    // Un Lote es de un Producto específico
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    // Un Lote tiene una Unidad de medida
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    // Relación con análisis
    public function analisis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Analisis::class)->orderBy('version', 'desc');
    }

    public function disposicion(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Disposicion::class);
    }
}
