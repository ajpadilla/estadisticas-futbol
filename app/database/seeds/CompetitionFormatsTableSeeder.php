<?php 

/**
* 
*/
class CompetitionFormatsTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $formats[] = array(
            'name' => 'Formato Liga Española',
            'local_away_game' => true, 
            'teams_by_group' => 20,
            'descent' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $formats[] = array(
            'name' => 'Formato Liga Argentina',
            'groups' => 1,
            'teams_by_group' => 20,
            'clasificated_by_group' => 20,
            'local_away_game' => false,
            'local_away_game_final' => false, 
            'promotion' => 0, 
            'descent' => 3, 
            'away_goal' => false,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $formats[] = array(
            'name' => 'Formato Liga Inglesa',
            'groups' => 8,
            'teams_by_group' => 2,
            'clasificated_by_group' => 1,
            'away_goal' => true,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        $formats[] = array(
            'name' => 'Copa Venezuela',
            'groups' => 4,
            'local_away_game' => true,
            'local_away_game_final' => true,
            'away_goal' => true,
            'teams_by_group' => 4,
            'clasificated_by_group' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')
        );

        foreach ($formats as $format) 
            DB::table('competition_formats')->insert($format);
	}

}