<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();

            // usuario 1
            $table->foreignId('user_one_id')
                ->constrained('users')
                ->onDelete('cascade');

            // usuario 2
            $table->foreignId('user_two_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamps();

            // evita duplicados exactos (A-B repetido)
            $table->unique(['user_one_id', 'user_two_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
