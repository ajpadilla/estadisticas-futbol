<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->enum('type', 
				array(
						'primera',
						'desempate descenso primera'
						'liguilla'
						'b nacional',
						'desempate ascenso b nacional'
						'desempate descenso b nacional'
						'reducido b nacional'
						'b metro',
						'desempate ascenso b metro'
						'desempate descenso b metro'
						'reducido b metro'
						'federal a',
						'desempate ascenso federal a'
						'desempate descenso federal a'
						'reducido federal a'
						'primera c',
						'desempate ascenso primera c'
						'desempate descenso primera c'
						'reducido primera c'
						'primera d',
						'desempate ascenso primera d'
						'desempate descenso primera d'
						'reducido primera d'
						'federal b',
						'desempate ascenso federal b'
						'desempate descenso federal b'
						'reducido federal b'
						'copa mundial',
						'eliminatorias copa mundial',
						'copa america',
						'copa libertadores',
						'champion L',
						'copa argentina',
						'sudamericana',
						'mundial de clubes'
				))
			->after('nombre');;
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
			 $table->dropColumn('type');
		});
	}

}
