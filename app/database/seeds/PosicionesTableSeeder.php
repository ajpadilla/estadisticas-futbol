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
            'nombre' => 'Portero',
            'abreviacion' => 'PO',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $posiciones[] = array(
            'nombre' => 'Defensor central',
            'abreviacion' => 'DC',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $posiciones[] = array(
            'nombre' => 'Defensor de corte',
            'abreviacion' => 'DDC',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Defensor lateral',
            'abreviacion' => 'DL',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $posiciones[] = array(
            'nombre' => 'Defensor libre por la banda',
            'abreviacion' => 'DLB',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Defensor de medio campo',
            'abreviacion' => 'DM',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Mediocampista defensivo',
            'abreviacion' => 'MCD',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );
         
        $posiciones[] = array(
            'nombre' => 'Mediocampista organizador',
            'abreviacion' => 'MC',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Mediocampista externo',
            'abreviacion' => 'INT',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );
         
        $posiciones[] = array(
            'nombre' => 'Mediocampista ofensivo',
            'abreviacion' => 'MCO',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Lateral volante',
            'abreviacion' => 'LV',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Volante de contención',
            'abreviacion' => 'VCT',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Volante de salida',
            'abreviacion' => 'VS',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Volante por la banda',
            'abreviacion' => 'VB',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Volante de creación',
            'abreviacion' => 'VCR',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Volante con llegada',
            'abreviacion' => 'VLl',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Punta neto',
            'abreviacion' => 'PN',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Segunda punta',
            'abreviacion' => 'SP',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Centro punta',
            'abreviacion' => 'SP',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Media punta',
            'abreviacion' => 'MP',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Extremo',
            'abreviacion' => 'PE',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Puntero',
            'abreviacion' => 'PP',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        $posiciones[] = array(
            'nombre' => 'Puntero',
            'abreviacion' => 'PP',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')              
        );

        DB::table('posiciones')->insert($posiciones);
	}

}