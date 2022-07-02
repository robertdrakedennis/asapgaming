<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->json('body')->nullable();
            $table->longText('plaintext')->nullable();
            $table->string('slug')->nullable();
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->integer('reply_count')->default(0);
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('isPinned')->nullable()->default(0);
            $table->boolean('isLocked')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('threads', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
