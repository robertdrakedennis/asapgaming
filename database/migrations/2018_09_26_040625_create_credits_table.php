<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
//        Schema::create('credits', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->integer('amount');
//            $table->integer('bonus_amount')->nullable();
//            $table->double('price', 2);
//            $table->timestamps();
//        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('credits');
    }
}
