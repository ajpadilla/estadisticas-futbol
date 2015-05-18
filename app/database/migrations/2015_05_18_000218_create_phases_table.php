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
			$table->date('from')->nullable();
			$table->date('to')->nullable();
			$table->string('local_away_game', 128)->default(false);
			$table->boolean('away_goal')->default(false);
			$table->integer('competition_id')->unsigned();
			$table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
			$table->integer('format_id')->unsigned();
			$table->foreign('format_id')->references('id')->on('competition_formats')->onDelete('cascade');
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
