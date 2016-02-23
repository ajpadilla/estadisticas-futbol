<?php 

use soccer\Player\Player;
use soccer\Posicion\Posicion;
use soccer\Pais\Pais;
/**
* 
*/
class PlayersTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();
        for ($i=0; $i <= 4000; $i++) {
            $player = Player::create(
                [
                    'nombre' => $faker->firstName . ' ' . $faker->lastName,
                    'apodo' => 'Futbolista', 'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
                    ////'foto' => 'public/system/soccer/Player/Player/fotos/000/000/010/original/Ramiro.jpg',
                    'altura' => $faker->randomFloat(2, 6, 100),
                    'peso' => $faker->randomFloat(2, 6, 100),
                    'peso' => $faker->randomFloat(2, 6, 100),
                    'pais_id' => $faker->randomFloat(0, 1, 6)
                ]);
        }
	}

}