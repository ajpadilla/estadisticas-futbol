<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJugadorPosicionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jugador_posicion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('principal');
			$table->integer('player_id')->unsigned()->index();
			$table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
			$table->integer('posicion_id')->unsigned()->index();
			$table->foreign('posicion_id')->references('id')->on('posiciones')->onDelete('cascade');
			$table->unique(array('player_id', 'posicion_id'), 'player_posicion_unique');
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
		Schema::dropIfExists('jugador_posicion');
	}


}
