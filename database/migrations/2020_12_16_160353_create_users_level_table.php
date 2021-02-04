<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_level', function (Blueprint $table) {

            $table->integer('id' ,true)->unique();
            $table->integer('level');
            $table->string('title');

        });

        DB::statement("ALTER TABLE `users` ADD FOREIGN KEY (`level_id`) REFERENCES `users_level`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_level');
    }
}
