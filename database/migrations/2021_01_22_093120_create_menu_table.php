<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->integer('product_id');
            $table->integer('restraunt_id');
            $table->integer('price');
            $table->integer('discount');
            $table->string('makeup','255');


            $table->foreign('product_id')
                ->references('id')->on('products');


            $table->foreign('restraunt_id')
                ->references('id')->on('restraunts');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
