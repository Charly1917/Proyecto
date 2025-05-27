<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
        });
    }

    public function down(): void {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->dropColumn(['colonia', 'ciudad', 'estado', 'pais']);
        });
    }
};

