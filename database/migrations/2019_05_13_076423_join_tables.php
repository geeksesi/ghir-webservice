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

        Schema::table('buy_order', function (Blueprint $table) {
            // join
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('sell_order', function (Blueprint $table) {
            // join
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('position', function (Blueprint $table) {
            // join
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('corr_id')->references('id')->on('user');
        });

        Schema::table('user', function (Blueprint $table) {
            // join
            // $table->foreign('account_id')->references('id')->on('account');
        });

        Schema::table('account', function (Blueprint $table) {
            // join
            $table->foreign('owner_id')->references('id')->on('user');
        });

        Schema::table('offset', function (Blueprint $table) {
            // join
            $table->foreign('position1_id')->references('id')->on('position');
            $table->foreign('position2_id')->references('id')->on('position');
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
