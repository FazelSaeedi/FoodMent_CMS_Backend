<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->string('address','255');
            $table->string('location','50');
            $table->integer('city_id');
            $table->integer('province_id');


            $table->foreign('province_id')
                ->references('id')->on('provinces');


            $table->foreign('city_id')
                ->references('id')->on('cities');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
