<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('slug')->nullable();
            $table->string('color')->nullable();
            $table->integer('thread_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->string('fontawesome')->nullable();
            $table->string('background')->nullable();
            $table->integer('weight')->default(0);
            $table->boolean('isLocked')->default(0);
            $table->boolean('isPrivate')->default(0);
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
