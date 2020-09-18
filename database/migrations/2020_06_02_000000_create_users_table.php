<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->json('cart')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('address')->nullable();
            $table->string('municipality')->nullable();
            $table->string('cap')->nullable();
            $table->string('password');
            $table->rememberToken();
            //$table->unsignedBigInteger('idumbrella')->nullable();


            $table->timestamps();
        });

        Schema::table('users', function($table) {
            //$table->foreign('idumbrella')->references('id')->on('beach_umbrellas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
