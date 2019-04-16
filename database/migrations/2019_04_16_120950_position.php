<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Position extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->increments('id');
            $table->bigInteger('position_gain');
            $table->string('position_type', 40);
            $table->unsignedBigInteger('position_price');
            $table->unsignedBigInteger('position_quantity');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('corr_id');
            $table->unsignedBigInteger('position_timestamp');
            $table->unsignedBigInteger('position_old_timestamp');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('position');
    }
}
