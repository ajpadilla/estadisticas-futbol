<?php 

/**
* 
*/
class GoalsTableSeeder extends DatabaseSeeder{
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
		$goalTypes = \soccer\Game\Goal\GoalType::all();
		foreach ($groups as $group) {
			$games = $group->games;
			foreach ($games as $game) {
				$goals = [];
				$teams[] = $game->localTeam;
				$teams[] = $game->awayTeam;

				foreach ($teams as $k => $team) {
					$goalsQuantity = $faker->numberBetween(0, 6);
					var_dump($team->nombre . ': ' . $goalsQuantity);
					$alignments = $game->alignments()->whereTeamId($team->id)->lists('player_id');
					$teamIdx = intval($k);
					$vsTeam = $teams[($teamIdx > 0 ? $teamIdx - 1 : $teamIdx + 1)];
					$vsAlignments = $game->alignments()->whereTeamId($vsTeam->id)->lists('player_id');
					for ($i = 0; $i < $goalsQuantity; $i++) {
						$goal = new \soccer\Game\Goal\Goal;
						$goal->minute = $faker->numberBetween(0,90);
						$goal->second = $faker->numberBetween(0,60);
						$goal->type()->associate($goalTypes->random(1));
						$goal->team()->associate($team);
						$alignment = $faker->randomElement($alignments);
						$assistance = $faker->randomElement($alignments);
						if ($goal->type_id == 2) {
							var_dump($vsAlignments);
							$alignment = $faker->randomElement($vsAlignments);
							var_dump('Jugador: ' . $alignment);
							$assistance = NULL;
						}
						$goal->player_id = $alignment;
						$goal->assistance_id = $assistance;
						$goals[] = $goal;
					}
				}
				$game->goals()->saveMany($goals);
			}

		}

	}

}