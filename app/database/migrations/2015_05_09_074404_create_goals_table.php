<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('observations')->nullable();
			$table->smallInteger('minute')->default(0);
			$table->smallInteger('second')->default(0);
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('goal_types')->onDelete('cascade');
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('equipos')->onDelete('cascade');			
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
			$table->integer('assistance_id')->unsigned()->nullable();
			$table->foreign('assistance_id')->references('id')->on('players')->onDelete('cascade');
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
		Schema::drop('goals');
	}

}
