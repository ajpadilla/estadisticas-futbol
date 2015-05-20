<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alignments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');			
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('equipos')->onDelete('cascade');
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');			
			$table->integer('position_id')->unsigned();
			$table->foreign('position_id')->references('id')->on('posiciones')->onDelete('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('alignment_types')->onDelete('cascade');
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
		Schema::drop('alignments');
	}

}
