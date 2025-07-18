<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposicion extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'disposiciones';

    protected $fillable = [
        'lote_id',
        'usuario_id',
        'tipo_disposicion',
        'motivo',
        'fecha_disposicion',
    ];

    protected $casts = [
        'fecha_disposicion' => 'datetime',
    ];

    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
