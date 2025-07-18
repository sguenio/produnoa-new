<?php

namespace App\Traits;

use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::logActivity('CREACIÓN', $model);
        });

        static::updated(function ($model) {
            self::logActivity('ACTUALIZACIÓN', $model);
        });

        static::deleted(function ($model) {
            self::logActivity('ELIMINACIÓN', $model);
        });
    }

    protected static function logActivity(string $actionType, $model)
    {
        $modelName = class_basename($model);
        $modelId = $model->id;
        $userName = Auth::check() ? Auth::user()->nombre : 'Sistema';

        Actividad::create([
            'usuario_id' => Auth::id(),
            'tipo_accion' => $actionType,
            'descripcion' => "{$userName} realizó una {$actionType} en {$modelName} ID: {$modelId}",
            'ip_address' => request()->ip(),
        ]);
    }
}
