<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPreviousIdToPhasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('phases', function(Blueprint $table)
		{
			$table->integer('previous_id')->unsigned()->nullable()->after('to');
			$table->foreign('previous_id')
				->references('id')
				->on('phases')
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
		Schema::table('phases', function(Blueprint $table)
		{
			$table->dropForeign('phases_previous_id_foreign');
			$table->dropColumn('previous_id');
		});
	}

}
