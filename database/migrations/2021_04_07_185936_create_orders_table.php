<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->bigInteger("userid")->unsigned();
            $table->integer("totalamount");
            $table->integer("totalprice");

            $table->boolean('isuserrequested')->default(0); // when user request for submit order          --- ok
            $table->boolean('isrestrauntaccepted')->default(0); // when restraunt accept ures Request      --- ok
            $table->boolean('isCanceled')->default(0); // when order canceled from user                    --- ok
            $table->boolean('ispaid')->default(0); // when user pay money                                  --- ok
            $table->boolean('isdelivered')->default(0); // when user receive                               --- ok

            $table->bigInteger('refid')->nullable();

            $table->timestamps();

            $table->foreign('userid')
                ->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
