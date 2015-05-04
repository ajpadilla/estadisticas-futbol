<?php 

/**
* 
*/
class CompetenciasTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $competencias[] = array(
        	'nombre' => 'La Liga',
        	'desde' => '2015-10-20',
        	'hasta' => '2016-05-20',
        	'internacional' => 0,
            'pais_id' => 5,
            'tipo_competencia_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       

        DB::table('competencias')->insert($competencias);
	}

}