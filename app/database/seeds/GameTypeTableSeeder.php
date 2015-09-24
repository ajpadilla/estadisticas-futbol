<?php 

/**
* 
*/
class GameTypeTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $date = new DateTime;
        
        $groups[] = array(
        	'name' => 'Amistoso',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $groups[] = array(
        	'name' => 'Oficial',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $groups[] = array(
        	'name' => 'Eliminatorio',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        DB::table('game_types')->insert($groups);
	}

}