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
            'historia' => 'La selección de fútbol de Argentina es el equipo representativo de dicho país en las competiciones oficiales. Su organización está a cargo de la Asociación del Fútbol Argentino (AFA), perteneciente a la Conmebol. Jugó el primer partido internacional fuera de Argentina, el 16 de mayo de 1901 en Montevideo. Es uno de los equipos más exitosos del fútbol mundial. Fue campeona en dos oportunidades de la Copa Mundial de Fútbol (1978 y 1986) y finalista en otras tres ocasiones (1930, 1990 y 2014). Al 2014, Argentina es (luego de Uruguay) la segunda selección que más veces ha ganado la Copa América, lográndola en 14 ocasiones. Además es la selección que más subcampeonatos logró en la competición, con doce. También posee una Copa Artemio Franchi lograda en el año 1993.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Argentina',
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
            'historia' => 'La selección de fútbol del Brasil (Seleção Brasileira de Futebol en portugués) es el equipo que representa a dicho país en las competiciones oficiales. Su organización está a cargo de la Confederación Brasileña de Fútbol, perteneciente a la Confederación Sudamericana de Fútbol (Conmebol). Conocida como «Scratch du Oro», «La Verde-amarela» o «La Canarinha», se encuentra afiliada a la FIFA desde 19232 y es miembro asociado y fundador de la Conmebol desde 1916. En materia dirigencial su actual presidente es José Maria Marin que figura como el 19.º presidente de la Confederación Brasileña de Fútbol, cargo que ocupa desde el 12 de marzo de 2012.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Brasil',
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
            'historia' => 'La Selección de fútbol de México (o selección mexicana de fútbol, como se le llama localmente)1 es el equipo masculino representativo del país en las competiciones oficiales. Su organización está a cargo de la Federación Mexicana de Fútbol, la cual está afiliada a la FIFA desde 1929 y es asociación fundadora de la CONCACAF, creada en 1961.2 Además existen otros equipos que son seleccionados mexicanos de fútbol, entre los que destacan la Olímpica, la Sub-20, la Sub-17, la Femenil y de Playa. La selección mexicana ha participado en quince ediciones de la Copa Mundial de Fútbol, obteniendo resultados notorios en las competiciones que disputó como anfitrión en 1970 y 1986 donde alcanzó la instancia de los cuartos de final y concluyó en el sexto lugar en ambos torneos.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_M%C3%A9xico',
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