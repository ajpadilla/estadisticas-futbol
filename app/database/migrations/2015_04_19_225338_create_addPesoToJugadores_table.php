<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddPesoToJugadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jugadores', function(Blueprint $table) 
		{    
			$table->renameColumn('abreviacion', 'apodo');
            $table->decimal('peso', 3, 2)->after('altura')->nullable(true)->default(null);
      	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jugadores', function(Blueprint $table) 
		{    
			$table->dropColumn('peso');
      	});
	}

}
