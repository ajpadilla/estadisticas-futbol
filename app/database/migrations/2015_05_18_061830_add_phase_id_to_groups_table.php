<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPhaseIdToGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groups', function(Blueprint $table)
		{
			$table->integer('phase_id')->unsigned()->nullable()->after('name');
			$table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');
			$table->unique('name', 'phase_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('groups', function(Blueprint $table)
		{
			$table->dropForeign('groups_phase_id_foreign');
			$table->dropColumn('phase_id');
		});
	}

}