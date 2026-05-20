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
        Schema::create('ofertas', function (Blueprint $table) {

            $table->id();

            // EMPLEADOR
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // INFORMACION PRINCIPAL
            $table->string('titulo');

            $table->text('descripcion');

            $table->string('ubicacion')->nullable();

            // CONTACTO
            $table->string('numero_contacto')->nullable();

            $table->string('email_contacto')->nullable();

            // REQUISITOS
            $table->text('requisitos_indispensables')->nullable();

            $table->text('requisitos_deseables')->nullable();

            // INFORMACION LABORAL
            $table->decimal('salario', 10, 2)->nullable();

            $table->string('modalidad')->nullable();
            // Presencial, Remoto, Híbrido

            $table->string('tipo_empleo')->nullable();
            // Tiempo completo, Medio tiempo, Freelance...

            $table->integer('vacantes')->default(1);

            // ESTADO
            $table->boolean('estado')->default(true);
            // true = activa
            // false = cerrada

            // FECHA LIMITE
            $table->date('fecha_limite')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};