<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade'); // Cambia 'users' a 'usuarios'
        $table->decimal('total', 10, 2);
        $table->enum('estado', ['pendiente', 'pagado', 'enviado', 'cancelado'])->default('pendiente');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
