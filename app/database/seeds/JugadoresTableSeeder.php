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


        $jugador = Jugador::create([
            'nombre' => 'Sergio Romero',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/001/original/102px-Sergio_Romero_2011.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'pais_id' => 3   
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Gerónimo Rulli',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/002/original/Krasnodar-Real_Sosiedad_(17).jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3      
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Nahuel Guzmán',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/003/original/Nahuel_Guzman.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3    
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Ezequiel Garay',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/004/original/Ezequiel_Garay_Benfica.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3   
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Nicolás Otamendi',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/005/original/Nicolas_Otamendi_6315.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3       
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Pablo Zabaleta',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/006/original/Zabaleta_Capitan.PNG',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3     
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Lucas Orbán',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/007/original/Lucas_Orban.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3    
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Marcos Rojo',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/008/original/Marcos_Rojo.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3   
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Mateo Musacchio',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/009/original/Musacchio.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3  
        ]);

        $jugador = Jugador::create([
            'nombre' => 'Ramiro Funes Mori',
            'apodo' => 'Futbolista',
            'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'foto' => 'public/system/soccer/Jugador/Jugador/fotos/000/000/010/original/Ramiro.jpg',
            'altura' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100),
            'peso' => $faker->randomFloat(2, 6, 100), 
            'pais_id' => 3   
        ]);
	}

}