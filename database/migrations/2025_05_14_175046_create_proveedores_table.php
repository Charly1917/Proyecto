<?php

// database/migrations/xxxx_xx_xx_create_proveedores_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
        $table->id(); // ← Este es el campo "id" que Laravel autogenera
        $table->string('nombre');
        $table->string('apellido_paterno');
        $table->string('apellido_materno');
        $table->string('email')->unique();
        $table->string('password');
        $table->unsignedBigInteger('role_id')->nullable();
        $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
