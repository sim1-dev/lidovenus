<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersUmbrellasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_umbrellas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_umbrella');
        });

        Schema::table('orders_umbrellas', function($table) {
            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_umbrella')->references('id')->on('beach_umbrellas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_umbrellas');
    }
}
