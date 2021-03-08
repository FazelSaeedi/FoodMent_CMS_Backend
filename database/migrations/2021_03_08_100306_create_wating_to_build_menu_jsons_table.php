<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatingToBuildMenuJsonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wating_to_build_menu_jsons', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->integer('restraunt_id')->unique();
            $table->bigInteger("timestamp");


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
        Schema::dropIfExists('wating_to_build_menu_jsons');
    }
}
