<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JoinTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('buy', function (Blueprint $table) {
            // join
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('seller_id')->references('id')->on('user');
            $table->foreign('buyer_id')->references('id')->on('user');
            $table->foreign('sell_id')->references('id')->on('sell');
        });

        Schema::table('sell', function (Blueprint $table) {
            // join
            $table->foreign('seller_id')->references('id')->on('user');
            $table->foreign('product_id')->references('id')->on('product');
        });

        Schema::table('product', function (Blueprint $table) {
            // join
            $table->foreign('price_id')->references('id')->on('product_price');
        });

        Schema::table('product_price', function (Blueprint $table) {
            // join
            // comment because we can't add a row without a non product_id exist and can't add product without non price_id exist ... IDK what happend :D
            // $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
