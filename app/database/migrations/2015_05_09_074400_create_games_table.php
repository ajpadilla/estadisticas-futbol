<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('date');
			$table->integer('local_team_id')->unsigned();
			$table->foreign('local_team_id')->references('id')->on('group_team')->onDelete('cascade');
			$table->integer('away_team_id')->unsigned();
			$table->foreign('away_team_id')->references('id')->on('group_team')->onDelete('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('game_types')->onDelete('cascade');
			$table->integer('competition_id')->unsigned();
			$table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
			$table->string('stadium', 128)->nullable();
			$table->string('main_referee', 128)->nullable();
			$table->string('line_referee', 128)->nullable();
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
		Schema::dropIfExists('games');
	}

}
