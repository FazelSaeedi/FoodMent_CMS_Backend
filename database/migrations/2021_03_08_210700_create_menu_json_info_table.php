<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuJsonInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_json_info', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->integer('restraunt_id')->unique();
            $table->bigInteger("create_timestamp");


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
        Schema::dropIfExists('_menu_json_info');
    }
}
