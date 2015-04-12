<?php

use soccer\Equipo\Equipo;
use soccer\Jugador\Jugador;


class EquiposTableSeeder extends DatabaseSeeder {

	public function run()
	{
        $faker = $this->getFaker();

        $equipos = array();
        
        $equipos[] = array(
        	'nombre' => 'México',
        	'escudo' => null,
        	'bandera' => null,
        	'tipo' => 'selección',
        	'fecha_fundacion' => 'México',
        	'apodo' => 'El Tri',
        	'ubicacion' => 'México',
        	'pais_id' => 1        	
        );

        $equipos[] = array(
        	'nombre' => 'Brasil',
        	'escudo' => null,
        	'bandera' => null,
        	'tipo' => 'selección',
        	'fecha_fundacion' => 'México',
        	'apodo' => 'La Canariña',
        	'ubicacion' => 'Brasil',
        	'pais_id' => 2        	
        );

        $equipos[] = array(
        	'nombre' => 'Argentina',
        	'escudo' => null,
        	'bandera' => null,
        	'tipo' => 'selección',
        	'fecha_fundacion' => 'México',
        	'apodo' => 'La Albiceleste',
        	'ubicacion' => 'Argentina',
        	'pais_id' => 3        	
        );   
        foreach ($equipos as $equipo) {
            Equipo::create($equipo);
        }

        $jugadores = Jugador::all();
        $equipos = Equipo::all()->toArray();

        foreach($jugadores as $jugador)
        {
            $equipo = $faker->randomElement($equipos);
            $equipo = Equipo::find($equipo['id']);

            $jugador->equipos()->save(
                $equipo, [
                'numero' => $faker->randomNumber(2),
                'fecha_inicio' => $faker->dateTime(),
                'fecha_fin' => null]
            );
        }        
	}

}