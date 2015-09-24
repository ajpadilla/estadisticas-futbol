<?php 

/**
* 
*/
class GroupTeamTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $groupTeam[] = array(
            'group_id' => 1,
            'team_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $groupTeam[] = array(
            'group_id' => 1,
            'team_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $groupTeam[] = array(
            'group_id' => 2,
            'team_id' => 4,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        $groupTeam[] = array(
            'group_id' => 2,
            'team_id' => 5,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        $groupTeam[] = array(
            'group_id' => 3,
            'team_id' => 6,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        $groupTeam[] = array(
            'group_id' => 3,
            'team_id' => 7,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );


        $competition = \soccer\Competition\Competition::find(4);
        $groups = $competition->phases()->find(4)->groups;
        $teams = array_chunk($competition->country->teams()->whereTipo('club')->lists('id'), 4);
        $i = 0;
        foreach ($groups as $group) {
            $group->teams()->attach($teams[$i]);
            $i++;
        }

        DB::table('group_team')->insert($groupTeam);
	}

}