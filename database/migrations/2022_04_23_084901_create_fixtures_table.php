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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('week');
            $table->unsignedBigInteger('home_team_id')->nullable();
            $table->unsignedBigInteger('away_team_id')->nullable();
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->boolean('played')->default(false);
        });
    }

    /**
     * Reverse the migrations.
 *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
};
