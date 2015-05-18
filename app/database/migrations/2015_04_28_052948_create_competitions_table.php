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
			$table->string('name', 128);
			$table->string('image', 128)->nullable();
			$table->date('from');
			$table->date('to');
			$table->boolean('international')->default(false);
			$table->integer('country_id')->unsigned()->nullable();	
			$table->foreign('country_id')
						->references('id')	
						->on('countries')
						->onDelete('no action')
						->onUpdate('cascade');				
			/*$table->integer('tipo_competencia_id')->unsigned();
			$table->foreign('tipo_competencia_id')
				->references('id')->on('tipo_competencias')
				->onUpdate('cascade')->onDelete('cascade');*/
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
		/*Schema::table('competitions', function(Blueprint $table)
		{
			$table->dropForeign('competitions_country_id_foreign');
		});*/
		Schema::drop('competitions');
	}

}
