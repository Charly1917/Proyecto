<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::table('productos', function (Blueprint $table) {
        $table->unsignedBigInteger('proveedor_id')->after('id');

        $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
    });
}

public function down(): void {
    Schema::table('productos', function (Blueprint $table) {
        $table->dropForeign(['proveedor_id']);
        $table->dropColumn('proveedor_id');
    });
}

};
