<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCoinflipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coinflips', function (Blueprint $table) {
            $table->foreign('player_one')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('player_two')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('winner')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coinflips', function (Blueprint $table) {
            $table->dropForeign(['player_one']);
            $table->dropForeign(['player_two']);
            $table->dropForeign(['winner']);
        });
    }
}
