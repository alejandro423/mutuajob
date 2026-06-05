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
    Schema::create('perfil_idiomas', function (Blueprint $table) {
        $table->id();

        $table->foreignId('perfil_id')
            ->constrained('perfil')
            ->onDelete('cascade');

        $table->foreignId('idioma_id')
            ->constrained('idiomas')
            ->onDelete('cascade');

        // nivel (A1-C2 o 1-5 según prefieras, aquí 1-5)
        $table->unsignedTinyInteger('nivel');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_idiomas');
    }
};
