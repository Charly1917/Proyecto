<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('pedidos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->decimal('total', 8, 2);
    $table->string('estado');
    $table->timestamps();

    // ✅ Corrección: apuntar a 'usuarios', no 'users'
    $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
});

}


    public function down(): void {
        Schema::dropIfExists('pedidos');
    }
};
