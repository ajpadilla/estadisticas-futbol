<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_team', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned()->index();
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->integer('team_id')->unsigned()->index();
			$table->foreign('team_id')->references('id')->on('equipos')->onDelete('cascade');
			$table->boolean('active')->default(true);
			$table->unique(['group_id', 'team_id']);
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
		Schema::dropIfExists('group_team');
	}

}
