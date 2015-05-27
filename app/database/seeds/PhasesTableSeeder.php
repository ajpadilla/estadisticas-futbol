<?php 

/**
* 
*/
class PhasesTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;     

        $groups[] = array(
        	'name' => 'Todos contra todos',
            'competition_id' => 1,
            'format_id' => 1,
            'from' => $date->format('Y-m-d h:m:s'),
            'to' => $date->format('Y-m-d h:m:s'),    
            'last' => true,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );          
        $date->modify('+1 day');
        $groups[] = array(
            'name' => 'Grupos',
            'competition_id' => 2,
            'format_id' => 2,
            'from' => $date->format('Y-m-d h:m:s'),
            'to' => $date->format('Y-m-d h:m:s'),                   
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
        $date->modify('+1 day');
        $groups[] = array(
            'name' => 'Octavos de final',
            'competition_id' => 2,
            'format_id' => 3,
            'from' => $date->format('Y-m-d h:m:s'),
            'to' => $date->format('Y-m-d h:m:s'),                   
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );         

        DB::table('phases')->insert($groups);
	}

}