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
        Schema::create('carrito_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que tiene el producto en su carrito
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Producto agregado
            $table->integer('cantidad')->default(1); // Cantidad de ese producto
            $table->decimal('subtotal', 8, 2); // Precio total por cantidad (puedes calcularlo con JS y pasarlo)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_detalles');
    }
};
