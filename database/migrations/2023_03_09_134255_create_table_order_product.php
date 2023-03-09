<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('Products');
            $table->string('product_name');
            $table->string('product_color');
            $table->string('product_size');
            $table->string('quantity');
            $table->string('price');
            $table->string('price_total');
            $table->bigInteger('id_order')->unsigned()->nullable();
            $table->foreign('id_order')->references('id')->on('Orders')->onDelete('cascade');
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
        Schema::dropIfExists('Order_details');
    }
}
