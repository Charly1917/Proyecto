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
        // Crear la tabla roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // admin, cliente
            $table->timestamps();
        });
    
        // Agregar role_id a la tabla usuarios
        Schema::table('usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->after('id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable(); // 🔴 Añadir esto
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); // 🔴 Y esto
            $table->timestamps();
});

    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
