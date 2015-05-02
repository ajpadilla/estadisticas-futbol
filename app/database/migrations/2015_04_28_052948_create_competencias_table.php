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
			$table->boolean('internacional');

			$table->integer('tipo_competencia_id')->unsigned();
			$table->foreign('tipo_competencia_id')
				->references('id')->on('tipo_competencias')
				->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::table('competencias', function(Blueprint $table)
		{
				$table->integer('pais_id')->unsigned()->nullable()->after('tipo_competencia_id');	
				$table->foreign('pais_id')
						->references('id')	
						->on('paises')
						->onDelete('no action')
						->onUpdate('cascade');	
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('competencias', function(Blueprint $table)
		{
			$table->dropForeign('competencias_pais_id_foreign');
			$table->dropColumn('pais_id');
		});
		Schema::drop('competencias');
	}

}
