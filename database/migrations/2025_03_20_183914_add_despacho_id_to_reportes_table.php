<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('reportes', function (Blueprint $table) {
            if (!Schema::hasColumn('reportes', 'despacho_id')) {
                $table->foreignId('despacho_id')
                      ->constrained('despachos')
                      ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('reportes', function (Blueprint $table) {
            if (Schema::hasColumn('reportes', 'despacho_id')) {
                $table->dropForeign(['despacho_id']);
                $table->dropColumn('despacho_id');
            }
        });
    }
};

