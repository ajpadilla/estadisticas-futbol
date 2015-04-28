<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoCompetenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_competencias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 128);
			$table->smallInteger('grupos')->default(1);
			$table->smallInteger('fases_eliminatorias')->default(0);
			$table->boolean('ida_vuelta')->default(false);
			$table->boolean('pre_clasificacion')->default(false);
			$table->smallInteger('equipos_por_grupo')->default(0);
			$table->smallInteger('ascenso')->default(0);
			$table->smallInteger('descenso')->default(0);
			$table->smallInteger('clasificados_por_grupo')->default(0);
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
		Schema::drop('tipo_competencias');
	}

}
