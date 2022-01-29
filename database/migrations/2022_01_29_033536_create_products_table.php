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
    {   /*
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->double('discount');
            $table->string('brand');
            $table->text('description');
            $table->integer('stock');
            $table->integer('sku');
            $table->integer('status');
            $table->string('image');
            $table->integer('certificate');
            $table->unsignedBigInteger('id_brand');
            $table->foreign('id_brand')-> references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_subcategory');
            $table->foreign('id_subcategory')-> references('id')->on('subcategories')->onUpdate('cascade')->onDelete('cascade'); 
            $table->timestamps();
        });
        */
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
