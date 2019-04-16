<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->increments('id');
            $table->string('name', 40);
            $table->string('user_name', 40);
            $table->text('password');
            $table->string('phone_number', 14);
            $table->string('user_status', 40);
            $table->unsignedInteger('account_id');
            $table->float('user_credit', 10, 4);
            $table->unsignedBigInteger('user_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
