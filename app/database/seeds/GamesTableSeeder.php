<?php 

/**
* 
*/
class GamesTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $competition = \soccer\Competition\Competition::find(4);
        $phase = $competition->phases()->find(4);
        $date = new DateTime($phase->from);
        $groups = $phase->groups;
        //$teams = array_chunk($competition->country()->teams->lists('id'), 4);
        foreach ($groups as $group) {
            $teams = $group->teams->lists('id');
            $teamsQuantity = count($teams);
            $i = 0;
            foreach ($teams as $team) {
                $i++;
                if($i >= $teamsQuantity)
                    break;

                $vsTeams = array_slice($teams, $i, $teamsQuantity - $i);
                $startGameDates = false;
                foreach ($vsTeams as $vsTeam) {
                    if ($startGameDates) {
                        $gameDate = $date->add(new DateInterval('P03D'))->format('Y-m-d H:i:s');
                        if ($phase->format->local_away_game) {
                            $awayGameDate = $date->add(new DateInterval('P08D'))->format('Y-m-d H:i:s');
                            $date->sub(new DateInterval('P08D'));
                        }
                        $date->sub(new DateInterval('P03D'));
                        $startGameDates = true;
                    } else {
                        $gameDate = $date->format('Y-m-d H:i:s');
                        if ($phase->format->local_away_game) {
                            $awayGameDate = $date->add(new DateInterval('P08D'))->format('Y-m-d H:i:s');
                            $date->sub(new DateInterval('P08D'));
                        }
                    }

                    $game = new \soccer\Game\Game;
                    $game->local_team_id = $team;
                    $game->away_team_id = $vsTeam;
                    $game->type_id = 2;
                    $game->group_id = $group->id;
                    $game->date = $gameDate;
                    $game->save();


                    if ($phase->format->local_away_game) {
                        $game = new \soccer\Game\Game;
                        $game->local_team_id = $vsTeam;
                        $game->away_team_id = $team;
                        $game->type_id = 2;
                        $game->group_id = $group->id;
                        $game->date = $awayGameDate;
                        $game->save();
                    }
                }
            }
        }
	}
}