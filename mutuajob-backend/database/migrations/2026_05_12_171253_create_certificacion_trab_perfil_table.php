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
    Schema::create('perfil_certificaciones', function (Blueprint $table) {

        $table->id();

        $table->foreignId('perfil_id')
            ->constrained('perfil')
            ->onDelete('cascade');

        $table->foreignId('certificacion_id')
            ->constrained('certificaciones')
            ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_certificaciones');
    }
};
