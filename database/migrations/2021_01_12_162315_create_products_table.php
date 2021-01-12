<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->integer("id" , true)->unique();
            $table->string("name" , '25');
            $table->integer("code");
            $table->integer("type");
            $table->integer("maingroup");
            $table->integer("subgroup");


            $table->foreign('type')
                 ->references('id')->on('types');

            $table->foreign('maingroup')
                ->references('id')->on('maingroups');

            $table->foreign('subgroup')
                ->references('id')->on('subgroups');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
