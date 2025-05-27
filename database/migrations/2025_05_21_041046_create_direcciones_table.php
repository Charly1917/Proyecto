<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo_postal_id');
            $table->string('calle');
            $table->string('numero');
            $table->string('referencias')->nullable();
            $table->timestamps();

           $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreign('codigo_postal_id')->references('id')->on('codigos_postales')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('direcciones');
    }
};
