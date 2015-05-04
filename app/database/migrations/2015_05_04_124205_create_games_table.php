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
			$table->enum('tipo', ['amitoso', 'oficial'])->default('oficial');
			$table->string('stadium', 128)->nullable();
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
		Schema::drop('games');
	}

}
