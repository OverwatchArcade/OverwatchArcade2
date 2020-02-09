<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game');
            $table->integer('tile_1')->default(1);
            $table->integer('tile_2')->default(1);
            $table->integer('tile_3')->default(1);
            $table->integer('tile_4')->default(1);
            $table->integer('tile_5')->default(1);
            $table->integer('tile_6')->default(1);
            $table->integer('tile_7')->default(1);
            $table->string('user_battlenet_id');
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
        Schema::dropIfExists('dailies');
    }
}
