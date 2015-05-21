<?php 

/**
* 
*/
class SanctionsTypesTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $date = new DateTime;
        
        $sanctionTypes[] = array(
        	'name' => 'Dar o intentar dar una patada a un adversario',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $sanctionTypes[] = array(
        	'name' => 'Poner o intentar poner una zancadilla a un adversario',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );        

        $sanctionTypes[] = array(
        	'name' => 'Saltar sobre un adversario',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );    

        $sanctionTypes[] = array(
            'name' => 'Empujar a un adversario',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );         

        DB::table('sanction_types')->insert($sanctionTypes);
	}

}