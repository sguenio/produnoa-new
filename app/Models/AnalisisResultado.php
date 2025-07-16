<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalisisResultado extends Model
{
    use HasFactory;
    protected $table = 'analisis_resultados';
    protected $fillable = ['analisis_id', 'parametro_id', 'valor_resultado', 'aprueba'];
    protected $casts = ['aprueba' => 'boolean'];

    public function analisis(): BelongsTo
    {
        return $this->belongsTo(Analisis::class);
    }
    public function parametro(): BelongsTo
    {
        return $this->belongsTo(ParametroAnalisis::class);
    }
}
