<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipoJugadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipo_jugador', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('numero');
			$table->date('fecha_inicio');
			$table->date('fecha_fin')->nullable();
			$table->integer('equipo_id')->unsigned()->index();
			$table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
			$table->integer('jugador_id')->unsigned()->index();
			$table->foreign('jugador_id')->references('id')->on('jugadores')->onDelete('cascade');
			$table->unique(array('equipo_id', 'jugador_id','fecha_inicio'), 'equipo_jugador_fecha_inicio_unique');
			//$table->unique(array('equipo_id','numero'), 'equipo_numero_unique');
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
		Schema::dropIfExists('equipo_jugador');
	}

}
