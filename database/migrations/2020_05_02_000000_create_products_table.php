<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('img')->nullable();
            $table->char('category',200);
            $table->decimal('price',8,2)->default(0);
            $table->text('description')->nullable();
            $table->unsignedInteger('quantitystock')->default(0);
            $table->unsignedBigInteger('brand')->nullable();
            
            $table->timestamps();
        });

        Schema::table('products', function($table) {
            $table->foreign('brand')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
