<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration // <-- Verifica que tenga esto
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'image')) { // Esto evita errores si ya existe
                $table->string('image')->nullable()->after('price');
            }
        });
    }
    // ... rest of the code
};