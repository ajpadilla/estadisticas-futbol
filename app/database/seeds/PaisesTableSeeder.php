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
            'nombre' => 'Mexico',
            'bandera' => null,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $paises[] = array(
            'nombre' => 'Brasil',
            'bandera' => null,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $paises[] = array(
            'nombre' => 'Argentina',
            'bandera' => null,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        DB::table('paises')->insert($paises);
	}

}