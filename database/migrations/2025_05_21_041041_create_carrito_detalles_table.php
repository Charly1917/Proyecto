<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoDetallesTable extends Migration
{
    public function up()
    {
        Schema::create('carrito_detalles', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('producto_id');

    $table->integer('cantidad')->default(1);
    $table->decimal('subtotal', 10, 2)->default(0.00);

    $table->timestamps();

    // Claves foráneas corregidas
    $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
});

    }

    public function down()
    {
        Schema::dropIfExists('carrito_detalles');
    }
}
