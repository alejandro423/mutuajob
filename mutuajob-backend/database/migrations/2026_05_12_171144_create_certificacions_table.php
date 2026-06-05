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
    Schema::create('certificaciones', function (Blueprint $table) {
        $table->id();

        $table->string('nombre');
        $table->string('institucion')->nullable();
        $table->text('descripcion')->nullable();
        $table->date('fecha_obtencion')->nullable();
        $table->date('fecha_expiracion')->nullable();
        $table->string('evidencia')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificaciones');
    }
};
