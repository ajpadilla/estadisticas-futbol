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
        	'name' => 'Titular',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $alignmentType[] = array(
        	'name' => 'Suplente',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        DB::table('alignment_types')->insert($alignmentType);
	}

}