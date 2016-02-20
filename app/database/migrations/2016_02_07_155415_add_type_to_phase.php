<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToPhase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('phases', function(Blueprint $table)
		{
			$table->enum('type',
				array(
					'',
					'fase de grupos',
					'octavos',
					'cuartos',
					'semifinal',
					'final',
					'repechaje',
					'tercer lugar'
				))
			->default(null)
			->after('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('phases', function(Blueprint $table)
		{
			$table->dropColumn('type');
		});
	}

}
