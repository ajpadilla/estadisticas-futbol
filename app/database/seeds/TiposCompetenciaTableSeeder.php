<?php 

/**
* 
*/
class TiposCompetenciaTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $tipos[] = array(
            'nombre' => 'Liga Española',
            'ida_vuelta' => 1, 
            'equipos_por_grupo' => 20,
            'descenso' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       

        DB::table('tipo_competencias')->insert($tipos);
	}

}