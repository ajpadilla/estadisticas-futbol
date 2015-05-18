<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('competitions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 128);
			$table->string('imagen', 128)->nullable();
			$table->date('desde');
			$table->date('hasta');
			$table->boolean('international')->default(false);
			$table->integer('tipo_competencia_id')->unsigned();
			$table->foreign('tipo_competencia_id')
				->references('id')->on('tipo_competencias')
				->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::table('competitions', function(Blueprint $table)
		{
				$table->integer('country_id')->unsigned()->nullable()->after('tipo_competencia_id');	
				$table->foreign('country_id')
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
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->dropForeign('competitions_country_id_foreign');
			$table->dropColumn('country_id');
		});
		Schema::drop('competitions');
	}

}
