<?php 

/**
* 
*/
class GroupsTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $groups[] = array(
        	'name' => 'Liga',
        	'phase_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $groups[] = array(
        	'name' => 'A',
        	'phase_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $groups[] = array(
        	'name' => 'B',
        	'phase_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        DB::table('groups')->insert($groups);
	}

}