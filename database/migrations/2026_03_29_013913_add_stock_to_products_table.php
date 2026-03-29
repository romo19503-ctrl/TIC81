<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregamos la columna stock con valor 0 por defecto
            $table->integer('stock')->default(0)->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Esto sirve para deshacer el cambio si te equivocas
            $table->dropColumn('stock');
        });
    }
};