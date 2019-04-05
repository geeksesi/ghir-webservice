<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sell extends Migration
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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedBigInteger('offer_value');
            $table->unsignedBigInteger('offer_price');
            $table->unsignedBigInteger('offer_timestamp');
            $table->char('offer_status', 10);
            $table->unsignedInteger('transaction_id')->nullable();
            $table->unsignedInteger('previous_offer')->nullable();
            $table->unsignedInteger('next_offer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sell');
    }
}
