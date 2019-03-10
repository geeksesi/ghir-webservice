<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Buy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->unsignedBigInteger('value');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('time');
            $table->char('status', 10);
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
