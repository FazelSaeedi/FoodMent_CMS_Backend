<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestrauntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restraunts', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->string("name" , '25');
            $table->bigInteger("user")->unsigned();
            $table->integer("code")->unique();
            $table->string("address" , '225');
            $table->string("gallery" , '225');
            $table->bigInteger("update_at");

            $table->foreign('user')
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
        Schema::dropIfExists('restraunt');
    }
}
