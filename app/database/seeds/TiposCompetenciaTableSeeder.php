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

        $tipos[] = array(
            'nombre' => 'Torneo por grupos 4 fases',
            'grupos' => 4,
            'fases_eliminatorias' => 3,
            'ida_vuelta' => 0, 
            'equipos_por_grupo' => 4,
            'clasificados_por_grupo' => 2,
            'descenso' => 0,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );         

        foreach ($tipos as $tipo) 
            DB::table('tipo_competencias')->insert($tipo);
	}

}