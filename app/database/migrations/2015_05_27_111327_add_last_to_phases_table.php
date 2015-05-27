<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLastToPhasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('phases', function(Blueprint $table)
		{
			$table->boolean('last')->default(false)->after('format_id');
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
			$table->dropColumn('last');
		});
	}

}
