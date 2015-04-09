<?php 

/**
* 
*/
class PosicionesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $posiciones[] = array(
            'nombre' => 'Delantero',
            'abreviacion' => 'Del',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $posiciones[] = array(
            'nombre' => 'Defensa',
            'abreviacion' => 'Def',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Lateral',
            'abreviacion' => 'La',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $posiciones[] = array(
            'nombre' => 'Portero',
            'abreviacion' => 'Por',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Lanzador',
            'abreviacion' => 'Lan',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Bateador',
            'abreviacion' => 'Bat',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        DB::table('posiciones')->insert($posiciones);
	}

}