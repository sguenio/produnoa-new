<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Analisis extends Model
{
    use HasFactory;
    protected $table = 'analisis';
    protected $fillable = ['lote_id', 'usuario_id', 'version', 'resultado_general', 'fecha_analisis', 'observaciones'];
    protected $casts = ['fecha_analisis' => 'datetime'];

    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class);
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
    public function resultados(): HasMany
    {
        return $this->hasMany(AnalisisResultado::class);
    }
}
