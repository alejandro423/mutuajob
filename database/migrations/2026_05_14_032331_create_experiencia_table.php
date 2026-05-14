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
        Schema::create('experiencias', function (Blueprint $table) {

    $table->id();

    $table->foreignId('perfil_id')
        ->constrained('perfil')
        ->onDelete('cascade');

    $table->string('empresa');

    $table->string('cargo');

    $table->string('tipo_empleo')->nullable();
    // Tiempo completo, Freelance, Medio tiempo, etc.

    $table->string('ubicacion')->nullable();

    $table->date('fecha_inicio');

    $table->date('fecha_fin')->nullable();

    $table->boolean('trabajo_actual')->default(false);

    $table->text('descripcion')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiencias');
    }
};
