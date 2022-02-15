<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('discount')->nullable(true);
            $table->text('description');
            $table->integer('stock');
            $table->string('sku');
            $table->integer('status');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4');
            $table->string('certificate')->nullable(true);
            $table->unsignedBigInteger('id_brand');
            $table->foreign('id_brand')-> references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_subcategory');
            $table->foreign('id_subcategory')-> references('id')->on('subcategories')->onUpdate('cascade')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
