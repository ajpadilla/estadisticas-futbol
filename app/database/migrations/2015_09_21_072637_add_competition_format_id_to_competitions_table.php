<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompetitionFormatIdToCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->integer('competition_format_id')->unsigned()->after('country_id');
			$table->foreign('competition_format_id')
						->references('id')
						->on('competition_formats')
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
			$table->dropForeign('competitions_competition_format_id_foreign');
			$table->dropColumn('competition_format_id');
		});
	}
}
