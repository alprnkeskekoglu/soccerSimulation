<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('power');
            $table->unsignedTinyInteger('points')->default(0);
            $table->unsignedTinyInteger('won')->default(0);
            $table->unsignedTinyInteger('drawn')->default(0);
            $table->unsignedTinyInteger('lost')->default(0);
            $table->unsignedTinyInteger('goals_for')->default(0);
            $table->unsignedTinyInteger('goals_against')->default(0);
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
        Schema::dropIfExists('teams');
    }
};
