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
            'code' => 'MX',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $paises[] = array(
            'nombre' => 'Brasil',
            'bandera' => null,
            'code' => 'BR',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $paises[] = array(
            'nombre' => 'Argentina',
            'bandera' => null,
            'code' => 'AR',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $paises[] = array(
            'nombre' => 'Venezuela',
            'bandera' => null,
            'code' => 'VE',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $paises[] = array(
            'nombre' => 'España',
            'bandera' => null,
            'code' => 'ES',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $paises[] = array(
            'nombre' => 'Colombia',
            'bandera' => null,
            'code' => 'CO',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        DB::table('paises')->insert($paises);
	}

}