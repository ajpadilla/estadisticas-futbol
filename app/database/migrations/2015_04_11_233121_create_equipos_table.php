<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 128);
			$table->string('escudo', 128)->nullable();
			$table->string('foto', 128)->nullable();
			$table->enum('tipo', array('club', 'selección'));
			$table->date('fecha_fundacion')->nullable();
			$table->string('apodo', 128)->nullable();			
			$table->text('ubicacion')->nullable();
			$table->text('historia')->nullable();
			$table->string('info_url', 128)->nullable();
			$table->string('facebook_url', 128)->nullable();
			$table->string('twitter_url', 128)->nullable();			
			$table->integer('country_id')->unsigned();
			$table->timestamps();
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('equipos');
	}

}
