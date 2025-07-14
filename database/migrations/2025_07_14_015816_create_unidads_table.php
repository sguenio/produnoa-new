<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Le decimos explícitamente que la tabla se llama 'unidades' (en plural correcto)
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('abreviatura', 10)->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidads');
    }
};
