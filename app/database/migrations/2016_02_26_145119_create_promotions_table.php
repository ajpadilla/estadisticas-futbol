<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->foreign('competition_id')
				->references('id')
				->on('competitions')
				->onDelete('no action')
				->onUpdate('cascade');
			$table->foreign('team_id')
				->references('id')
				->on('equipos')
				->onDelete('no action')
				->onUpdate('cascade');
			$table->unique(array('competition_id', 'team_id'), 'promotions_unique');
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
		$table->dropForeign('promotions_competition_id_foreign');
		$table->dropForeign('promotions_team_id_foreign');
		Schema::drop('promotions');
	}

}
