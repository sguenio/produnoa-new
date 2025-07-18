<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remito extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'proveedor_id',
        'codigo_remito',
        'fecha_recepcion',
        'observaciones',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_recepcion' => 'date',
    ];

    /**
     * Define la relación: Un Remito pertenece a un Proveedor.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class);
    }
}
