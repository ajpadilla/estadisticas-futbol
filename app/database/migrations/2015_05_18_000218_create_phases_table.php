<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->date('from');
			$table->date('to');
			$table->string('local_away_game', 128)->default(false);
			$table->integer('competition_id')->unsigned();
			$table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
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
		Schema::drop('phases');
	}

}
