<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table -> id();
            $table -> string('razon_social');
            $table -> string('rut');
            $table -> string('giro');
            $table -> string('direccion');
            $table -> string('ciudad');
            $table -> string('comuna');
            $table -> string('telefono');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas', function (Blueprint $table) {
            //
        });
    }
};
