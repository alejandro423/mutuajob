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
    Schema::create('perfil_habilidad', function (Blueprint $table) {
        $table->id();

        $table->foreignId('perfil_id')
            ->constrained('perfil')
            ->onDelete('cascade');

        $table->foreignId('habilidad_id')
            ->constrained('habilidades')
            ->onDelete('cascade');

        // nivel de dominio (1 a 5)
        $table->unsignedTinyInteger('nivel');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_habilidad');
    }
};
