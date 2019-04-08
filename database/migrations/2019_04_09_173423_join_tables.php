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
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('product_id')->references('id')->on('product');
        });

        Schema::table('sell', function (Blueprint $table) {
            // join
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('product_id')->references('id')->on('product');
        });

        Schema::table('product', function (Blueprint $table) {
            // join
            // $table->foreign('price_id')->references('id')->on('product_price');
        });

        Schema::table('product_price', function (Blueprint $table) {
            // join
            $table->foreign('product_id')->references('id')->on('product');
        });

        Schema::table('transaction', function (Blueprint $table) {
            // join
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('seller_id')->references('id')->on('user');
            $table->foreign('buyer_id')->references('id')->on('user');
        });

        Schema::table('inventory', function (Blueprint $table) {
            // join
            $table->foreign('user_id')->references('id')->on('user');
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
