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
            $table->integer("restraunt_id");
            $table->bigInteger("restraunt_code");

            $table->boolean('isuserrequested')->default(0); // when user request for submit order          --- ok
            $table->boolean('isrestrauntaccepted')->default(0); // when restraunt accept ures Request      --- ok
            $table->boolean('ispaid')->default(0); // when user pay money                                  --- ok
            $table->boolean('isbaking')->default(0); // when user pay money                                --- ok // new
            $table->boolean('issend')->default(0); // when restaurant send food                            --- ok // new
            $table->boolean('iscansel')->default(0); // when restaurant send food                            --- ok // new
            $table->string('description','255');      // when Restaurant cansel Order In any case


            $table->bigInteger('refid')->nullable();

            $table->timestamps();

            $table->foreign('restraunt_id')
                ->references('id')->on('restraunts');

            $table->foreign('restraunt_code')
                ->references('code')->on('restraunts')->onUpdate('CASCADE');

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
