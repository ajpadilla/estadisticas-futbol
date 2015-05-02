<?php 

/**
* 
*/
class PosicionJugadorTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 1,
            'posicion_id' => 1, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 2,
            'posicion_id' => 2, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

       $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 3,
            'posicion_id' => 3, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );   

       $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 4,
            'posicion_id' => 4, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

       $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 5,
            'posicion_id' => 5, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

       $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 6,
            'posicion_id' => 6, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

       $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 7,
            'posicion_id' => 7, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       
        $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 8,
            'posicion_id' => 8, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       

        $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 9,
            'posicion_id' => 9, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       
         
        $jugador_posicion[] = array(
            'principal' => 1,
            'jugador_id' => 10,
            'posicion_id' => 10, 
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
       

        DB::table('jugador_posicion')->insert($jugador_posicion);
	}

}