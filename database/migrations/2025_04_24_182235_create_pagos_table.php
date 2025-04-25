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
    Schema::create('pagos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pedido_id');
        $table->string('metodo'); // tarjeta, paypal, etc.
        $table->string('estado')->default('pendiente');
        $table->decimal('monto', 10, 2);
        $table->timestamp('fecha_pago')->nullable();
        $table->timestamps();

        $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
