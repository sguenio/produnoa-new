<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'codigo_interno',
        'nombre',
        'categoria_id',
    ];

    /**
     * Define la relación: Un Producto pertenece a una Categoría.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
