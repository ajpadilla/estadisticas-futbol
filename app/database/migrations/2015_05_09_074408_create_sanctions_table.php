<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSanctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sanctions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('observations')->nullable();
			$table->smallInteger('minute')->default(0);
			$table->smallInteger('second')->default(0);
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('sanction_types')->onDelete('cascade');
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
		Schema::drop('sanctions');
	}

}
