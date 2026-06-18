<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // a qué conversación pertenece
            $table->foreignId('conversation_id')
                ->constrained()
                ->onDelete('cascade');

            // quien envió el mensaje
            $table->foreignId('sender_id')
                ->constrained('users')
                ->onDelete('cascade');

            // contenido
            $table->text('message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};