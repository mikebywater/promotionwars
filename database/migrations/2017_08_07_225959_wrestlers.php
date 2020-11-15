<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Wrestlers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wrestlers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('draw');
            $table->integer('ability');
            $table->integer('charisma');
            $table->integer('mic_skills');
            $table->string('condition');
            $table->integer('hardcore');
            $table->string('disposition');
            $table->integer('promotion_id')->nullable();
            $table->integer('game_id');
            $table->integer('age');
            $table->text('bio');
            $table->string('style');
            $table->string('weight');
            $table->string('role');
            $table->integer('manager_id')->nullable();
            $table->integer('partner_id')->nullable();
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
        Schema::dropIfExists('wrestlers');
    }
}
