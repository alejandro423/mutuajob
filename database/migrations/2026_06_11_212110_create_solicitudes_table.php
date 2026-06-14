<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('solicitudes', function (Blueprint $table) {

    $table->id();

    $table->foreignId('perfil_id')
        ->constrained('perfil')
        ->cascadeOnDelete();

    $table->foreignId('oferta_id')
        ->constrained('ofertas')
        ->cascadeOnDelete();

    $table->enum('tipo', [
        'postulacion',
        'invitacion'
    ]);

    $table->enum('estado', [
        'pendiente',
        'revision',
        'aceptada',
        'rechazada'
    ])->default('pendiente');

    $table->text('mensaje')->nullable();

    $table->timestamps();

    $table->unique([
        'perfil_id',
        'oferta_id',
        'tipo'
    ]);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};