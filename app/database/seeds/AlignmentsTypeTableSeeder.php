<?php 

/**
* 
*/
class AlignmentsTypeTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $date = new DateTime;
        
        $alignmentType[] = array(
        	'name' => '4-3-3',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $alignmentType[] = array(
        	'name' => '4-4-2',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $alignmentType[] = array(
        	'name' => '5-3-2',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );    

        $alignmentType[] = array(
            'name' => '4-5-1',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $alignmentType[] = array(
            'name' => '4-4-1-1',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );           

        DB::table('alignment_types')->insert($alignmentType);
	}

}