<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('codigos_postales', function (Blueprint $table) {
    $table->id();
    $table->string('codigo_postal');
    $table->string('colonia');
    $table->string('ciudad');       // ✅ Debe existir
    $table->string('estado');       // ✅ Debe existir
    $table->string('pais');         // ✅ Debe existir
    $table->timestamps();
});

    }

    public function down(): void {
        Schema::dropIfExists('codigos_postales');
    }
};
