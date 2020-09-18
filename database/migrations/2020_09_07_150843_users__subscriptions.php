<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_subsc');
            
            $table->timestamps();
        });

        Schema::table('users_subscriptions', function($table) {
            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_subsc')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_subscriptions');
    }
}
