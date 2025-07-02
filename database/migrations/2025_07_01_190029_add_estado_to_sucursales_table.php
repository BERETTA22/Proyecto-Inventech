<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sucursales', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('contacto'); // o ponlo después de cualquier otra columna que prefieras
        });
    }

    public function down(): void
    {
        Schema::table('sucursales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
