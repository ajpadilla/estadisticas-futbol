<?php 

use soccer\Jugador\Jugador;
use soccer\Posicion\Posicion;
use soccer\Pais\Pais;
/**
* 
*/
class JugadoresTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

        /*$posiciones = Posicion::all()->toArray();

        $paises = Pais::all()->toArray();

        for ($i=0; $i < 100; $i++) { 
            $posicion = $faker->randomElement($posiciones);
            $pais = $faker->randomElement($paises);

            Jugador::create([
                'nombre' => $faker->name,
                'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'foto' => null,
                'altura' => $faker->randomFloat(2, 6, 100),
                'abreviacion' => $faker->word, 
                'posicion_id' => $posicion['id'],
                'pais_id' => $pais['id']
            ]);
        }*/

        $date = new DateTime;

        //Porteros
        $jugadores[] = array(
            'nombre' => 'Sergio Romero',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 1,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Gerónimo Rulli',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 1,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Nahuel Guzmán',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 1,
            'pais_id' => 3         
        );

        // Defensas
        $jugadores[] = array(
            'nombre' => 'Ezequiel Garay',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Nicolás Otamendi',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Pablo Zabaleta',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Lucas Orbán',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Marcos Rojo',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Mateo Musacchio',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Ramiro Funes Mori',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 2,
            'pais_id' => 3         
        );

        // Defensas
        $jugadores[] = array(
            'nombre' => 'Federico Mancuello',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

         $jugadores[] = array(
            'nombre' => 'Lucas Biglia',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Ángel Di María',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Javier Mascherano',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

         $jugadores[] = array(
            'nombre' => 'Javier Pastore',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Éver Banega',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Maximiliano Rodríguez',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Maximiliano Rodríguez',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Roberto Pereyra',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 8,
            'pais_id' => 3         
        );

        //Delantero
        $jugadores[] = array(
            'nombre' => 'Gonzalo Higuaín',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 25,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Lionel Messi',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 25,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Sergio Agüero',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 25,
            'pais_id' => 3         
        );

        $jugadores[] = array(
            'nombre' => 'Ezequiel Lavezzi',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 25,
            'pais_id' => 3         
        );

         $jugadores[] = array(
            'nombre' => 'Carlos Tevez',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => null,
            'altura' => $faker->randomFloat(2, 6, 100),
            'abreviacion' => $faker->word, 
            'posicion_id' => 25,
            'pais_id' => 3         
        );

        DB::table('jugadores')->insert($jugadores);
	}

}