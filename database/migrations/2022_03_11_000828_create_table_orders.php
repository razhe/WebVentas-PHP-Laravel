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
        Schema::create('orders', function (Blueprint $table) {
            $table -> id();
            $table -> integer('total_neto');
            $table -> integer('iva');
            $table -> integer('total');
            $table -> date('fecha');
            $table->unsignedBigInteger('id_user') -> nullable(true);
            $table->foreign('id_user')-> references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_boleta') -> nullable(true);
            $table->foreign('id_boleta')-> references('id')->on('boletas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_factura') -> nullable(true);
            $table->foreign('id_factura')-> references('id')->on('facturas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_pago') -> nullable(true);
            $table->foreign('id_pago')-> references('id')->on('pagos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
