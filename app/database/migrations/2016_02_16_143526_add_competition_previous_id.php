<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompetitionPreviousId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->integer('previous_id')->unsigned()->nullable()->after('competition_format_id');
			/*$table->foreign('previous_id')
				->references('id')
				->on('competitions')
				->onDelete('no action')
				->onUpdate('cascade');*/
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
			//$table->dropForeign('competitions_previous_id_foreign');
			$table->dropColumn('previous_id');
		});
	}

}
