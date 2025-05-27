<?php

// database/migrations/xxxx_xx_xx_create_mensajes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email');
            $table->text('mensaje');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mensajes');
    }
};

