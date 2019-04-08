<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('inventory_change');
            $table->unsignedTinyInteger('inventory_change_type'); // 1 = decrease and 2 = increase
            $table->unsignedBigInteger('inventory_current');
            $table->char('inventory_status', 25);
            $table->unsignedBigInteger('inventory_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory');
    }
}
