<?php 

/**
* 
*/
class PaisesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $paises[] = array(
            'nombre' => 'Venezuela',
            'bandera' => 'VEN',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $paises[] = array(
            'nombre' => 'Estados Unidos',
            'bandera' => 'USA',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        DB::table('paises')->insert($paises);
	}

}