<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinflipStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinflip_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('games_won')->nullable();
            $table->unsignedInteger('games_lost')->nullable();
            $table->unsignedInteger('total_games_played')->nullable();
            $table->unsignedInteger('money_won')->nullable();
            $table->unsignedInteger('money_lost')->nullable();
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
        Schema::dropIfExists('coinflip_stats');
    }
}
