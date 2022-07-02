<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinflipTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinflips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('player_one');
            $table->unsignedInteger('player_one_prediction');
            $table->unsignedInteger('player_one_bet');
            $table->unsignedInteger('player_two')->nullable();
            $table->unsignedInteger('player_two_prediction')->nullable();
            $table->unsignedInteger('result')->nullable();
            $table->unsignedInteger('winner')->nullable();
            $table->boolean('game_finished')->default(false);
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
        Schema::dropIfExists('coinflip');
    }
}
