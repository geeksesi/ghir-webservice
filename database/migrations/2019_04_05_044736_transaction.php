<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->increments('id');
            $table->unsignedInteger('seller_id');
            $table->unsignedInteger('buyer_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('offer_id');
            $table->unsignedTinyInteger('offer_type'); // 1 = sell or 2 = buy
            $table->unsignedBigInteger('transaction_value');
            $table->unsignedBigInteger('transaction_price');
            $table->char('transaction_status', 25);
            $table->unsignedBigInteger('transaction_timestamp');
        });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction');
    }
}
