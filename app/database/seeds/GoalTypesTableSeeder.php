<?php 

/**
* 
*/
class GoalTypesTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $date = new DateTime;
        
        $goalTypes[] = array(
        	'name' => 'De penalti',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $goalTypes[] = array(
        	'name' => 'Autogol',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $goalTypes[] = array(
        	'name' => 'Gol olímpico',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );    

        $goalTypes[] = array(
            'name' => 'Libre directo',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );         

        DB::table('goal_types')->insert($goalTypes);
	}

}