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
			$table->integer('jugador_id')->unsigned()->index();
			$table->foreign('jugador_id')->references('id')->on('jugadores')->onDelete('cascade');
			$table->integer('posicion_id')->unsigned()->index();
			$table->foreign('posicion_id')->references('id')->on('posiciones')->onDelete('cascade');
			$table->unique(array('jugador_id', 'posicion_id'), 'jugador_posicion_unique');
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
