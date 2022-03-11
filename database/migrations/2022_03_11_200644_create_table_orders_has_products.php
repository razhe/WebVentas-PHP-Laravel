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
        Schema::create('orders_has_products', function (Blueprint $table) {
            $table -> id();
            $table -> integer('quantity');
            $table -> unsignedBigInteger('id_product') -> nullable(true);
            $table -> foreign('id_product')-> references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table -> unsignedBigInteger('id_order') -> nullable(true);
            $table -> foreign('id_order')-> references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_has_products', function (Blueprint $table) {
            //
        });
    }
};
