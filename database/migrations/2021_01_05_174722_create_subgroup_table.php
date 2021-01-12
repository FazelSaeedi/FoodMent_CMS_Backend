<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subgroups', function (Blueprint $table) {
            $table->integer("id" , false)->primary();
            $table->string("title" , '25');

            // $table->integer("maingroup");



            // $table->foreign('maingroup')
            //     ->references('id')->on('maingroup');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subgroup');
    }
}
