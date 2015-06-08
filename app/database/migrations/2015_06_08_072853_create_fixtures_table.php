<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFixturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fixtures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description', 256)->nullable();
			//$table->string('time', 6);
			$table->smallInteger('minute')->default(0);
			$table->smallInteger('second')->default(0);			
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('fixture_types')->onDelete('cascade');
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			/*$table->integer('team_id')->unsigned()->nullable();
			$table->integer('player_id')->unsigned()->nullable();
			$table->integer('assistance_id')->unsigned()->nullable();*/
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
		Schema::drop('fixtures');
	}

}
