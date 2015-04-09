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

        $posiciones = Posicion::all()->toArray();

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
        }
	}

}