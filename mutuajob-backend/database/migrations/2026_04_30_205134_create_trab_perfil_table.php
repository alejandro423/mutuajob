<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('perfil', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('nombre');
        $table->string('apellido')->nullable();
        $table->string('dni', 30)->nullable()->unique();
        $table->date('fecha_nacimiento')->nullable();
        $table->enum('sexo', ['masculino','femenino','otro'])->nullable();
        $table->string('foto')->nullable();
        $table->string('telefono', 30)->nullable();
        $table->string('ubicacion')->nullable();
        $table->string('email')->unique();
        $table->text('resumen_profesional')->nullable();
        $table->boolean('estado')->default(1);

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('perfil');
    }
};