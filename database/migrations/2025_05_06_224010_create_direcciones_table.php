<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesTable extends Migration
{
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('calle');
            $table->string('colonia');
            $table->string('numero_exterior')->nullable();
            $table->string('numero_interior')->nullable();
            $table->foreignId('codigo_postal_id')->constrained('codigos_postales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
