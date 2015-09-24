<?php 

/**
* 
*/
class AlignmentsTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();
		$competition = \soccer\Competition\Competition::find(4);
		$phase = $competition->phases()->find(4);
		$groups = $phase->groups;
		$positions = \soccer\Posicion\Posicion::all()->lists('id');
		foreach ($groups as $group) {
			$games = $group->games;
			foreach ($games as $game) {
				$localTeam = $game->localTeam;
				$awayTeam = $game->awayTeam;

				$localPlayers = array_chunk($localTeam->jugadores->lists('id'), 11);
				$awayPlayers = array_chunk($awayTeam->jugadores->lists('id'), 11);

				$alignments = [];
				for ($i = 0; $i < count($localPlayers); $i++) {
					foreach ($localPlayers[$i] as $localPlayer) {
						$alignment = new \soccer\Game\Alignment\Alignment();
						$alignment->player_id = $localPlayer;
						$alignment->team()->associate($localTeam);
						$alignment->type_id = $i+1;
						$alignment->position_id = $faker->randomElement($positions);
						$alignments[] = $alignment;
					}

					foreach ($awayPlayers[$i] as $awayPlayer) {
						$alignment = new \soccer\Game\Alignment\Alignment();
						$alignment->player_id = $awayPlayer;
						$alignment->team()->associate($awayTeam);
						$alignment->type_id = $i+1;
						$alignment->position_id = $faker->randomElement($positions);
						$alignments[] = $alignment;
					}
				}
				$game->alignments()->saveMany($alignments);
			}

		}

	}

}