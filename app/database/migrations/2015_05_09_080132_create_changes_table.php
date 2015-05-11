<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('changes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('observations')->nullable();
			$table->smallInteger('minute')->default(0);
			$table->smallInteger('second')->default(0);
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('equipos')->onDelete('cascade');			
			$table->integer('player_out_id')->unsigned();
			$table->foreign('player_out_id')->references('id')->on('players')->onDelete('cascade');
			$table->integer('player_in_id')->unsigned();
			$table->foreign('player_in_id')->references('id')->on('players')->onDelete('cascade');
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
		Schema::drop('changes');
	}

}
