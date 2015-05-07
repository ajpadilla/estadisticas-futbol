<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJugadores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function($table){
			$table->increments('id');
			$table->string('nombre', 128);
			$table->string('apodo', 128)->nullable(true);
			$table->date('fecha_nacimiento')->nullable(true);
			$table->text('lugar_nacimiento')->nullable();
			$table->string('foto', 128)->nullable(true)->default(null);
			$table->decimal('altura', 10, 2)->nullable(true)->default(null);
			$table->decimal('peso', 10, 2)->nullable(true)->default(null);
			$table->text('historia')->nullable();
			$table->string('info_url', 128)->nullable();
			$table->string('facebook_url', 128)->nullable();
			$table->string('twitter_url', 128)->nullable();
			$table->timestamps();
		});
		
		/*Schema::table('players', function(Blueprint $table)
		{
				$table->integer('posicion_id')->unsigned()->after('peso');	
				$table->foreign('posicion_id')
						->references('id')	
						->on('posiciones')
						->onDelete('no action')
						->onUpdate('cascade');	
		});*/

		Schema::table('players', function(Blueprint $table)
		{
				$table->integer('pais_id')->unsigned()->after('peso');	
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
		Schema::table('players', function(Blueprint $table)
		{
			//$table->dropForeign('players_posicion_id_foreign');
			//$table->dropColumn('posicion_id');
			$table->dropForeign('players_pais_id_foreign');
			$table->dropColumn('pais_id');
		});
		Schema::dropIfExists('players');
	}

}
