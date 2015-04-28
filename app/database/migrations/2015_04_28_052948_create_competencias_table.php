<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('competencias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 128);
			$table->string('imagen', 128)->nullable();
			$table->date('desde');
			$table->date('hasta');
			$table->integer('tipo_competencia_id')->unsigned();
			$table->foreign('tipo_competencia_id')
				->references('id')->on('tipo_competencias')
				->onUpdate('cascade')->onDelete('cascade');
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
		Schema::drop('competencias');
	}

}
