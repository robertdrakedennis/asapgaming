<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->bigInteger('steam_account_id')->unique();
            $table->string('avatar')->nullable();
            $table->string('background')->nullable();
            $table->json('about')->nullable();
            $table->longtext('plaintext')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->integer('post_count')->default(0);
            $table->bigInteger('credits')->default(0);
            $table->bigInteger('total_credits')->default(0);
            $table->enum('donator_tier', ['tier_1', 'tier_2', 'tier_3', 'tier_4', 'tier_5'])->nullable();
            $table->string('registered_ip')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
