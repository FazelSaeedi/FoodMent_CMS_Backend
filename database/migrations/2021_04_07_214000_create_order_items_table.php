<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {


            $table->integer("id" , true)->unique();
            $table->integer('orderid');
            $table->integer('menuproductid');

            $table->integer("count");
            $table->integer('price');
            $table->integer('discountrate');
            $table->integer('totalprice');

            $table->timestamps();


            $table->foreign('orderid')
                ->references('id')->on('orders');


            $table->foreign('menuproductid')
                ->references('id')->on('menu');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
