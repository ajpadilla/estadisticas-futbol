<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetitionFormatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('competition_formats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->smallInteger('groups')->default(1);
			$table->smallInteger('clasification_phases')->default(0);
			$table->smallInteger('clasificated_by_group')->default(0);
			$table->boolean('local_away_game')->default(false);
			$table->boolean('local_away_game_final')->default(false);
			$table->boolean('away_goal')->default(false);			
			$table->smallInteger('teams_by_group')->default(0);
			$table->smallInteger('promotion')->default(0);			
			$table->smallInteger('descent')->default(0);			
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
		Schema::drop('competition_formats');
	}

}