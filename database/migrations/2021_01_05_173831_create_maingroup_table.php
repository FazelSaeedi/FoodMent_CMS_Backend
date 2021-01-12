<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaingroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maingroups', function (Blueprint $table) {
            $table->integer("id" , false)->primary();
            $table->string("title" , '25');

            // $table->integer("typeid");



            // $table->foreign('typeid')
            //     ->references('id')->on('type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maingroup');
    }
}
