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
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/001/original/mexico.jpg', 
        	'tipo' => 'selección',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => 'El Tri',
        	'ubicacion' => 'México',
            'historia' => 'La selección de fútbol de Argentina es el equipo representativo de dicho país en las competiciones oficiales. Su organización está a cargo de la Asociación del Fútbol Argentino (AFA), perteneciente a la Conmebol. Jugó el primer partido internacional fuera de Argentina, el 16 de mayo de 1901 en Montevideo. Es uno de los equipos más exitosos del fútbol mundial. Fue campeona en dos oportunidades de la Copa Mundial de Fútbol (1978 y 1986) y finalista en otras tres ocasiones (1930, 1990 y 2014). Al 2014, Argentina es (luego de Uruguay) la segunda selección que más veces ha ganado la Copa América, lográndola en 14 ocasiones. Además es la selección que más subcampeonatos logró en la competición, con doce. También posee una Copa Artemio Franchi lograda en el año 1993.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Argentina',
        	'pais_id' => 1        	
        );

        $equipos[] = array(
        	'nombre' => 'Brasil',
        	'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/002/original/brazil.jpg',
        	'tipo' => 'selección',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => 'La Canariña',
        	'ubicacion' => 'Brasil',
            'historia' => 'La selección de fútbol del Brasil (Seleção Brasileira de Futebol en portugués) es el equipo que representa a dicho país en las competiciones oficiales. Su organización está a cargo de la Confederación Brasileña de Fútbol, perteneciente a la Confederación Sudamericana de Fútbol (Conmebol). Conocida como «Scratch du Oro», «La Verde-amarela» o «La Canarinha», se encuentra afiliada a la FIFA desde 19232 y es miembro asociado y fundador de la Conmebol desde 1916. En materia dirigencial su actual presidente es José Maria Marin que figura como el 19.º presidente de la Confederación Brasileña de Fútbol, cargo que ocupa desde el 12 de marzo de 2012.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Brasil',
        	'pais_id' => 2        	
        );

        $equipos[] = array(
        	'nombre' => 'Argentina',
        	'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/003/original/argentina.jpg', 
        	'tipo' => 'selección',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => 'La Albiceleste',
        	'ubicacion' => 'Argentina',
            'historia' => 'La Selección de fútbol de México (o selección mexicana de fútbol, como se le llama localmente)1 es el equipo masculino representativo del país en las competiciones oficiales. Su organización está a cargo de la Federación Mexicana de Fútbol, la cual está afiliada a la FIFA desde 1929 y es asociación fundadora de la CONCACAF, creada en 1961.2 Además existen otros equipos que son seleccionados mexicanos de fútbol, entre los que destacan la Olímpica, la Sub-20, la Sub-17, la Femenil y de Playa. La selección mexicana ha participado en quince ediciones de la Copa Mundial de Fútbol, obteniendo resultados notorios en las competiciones que disputó como anfitrión en 1970 y 1986 donde alcanzó la instancia de los cuartos de final y concluyó en el sexto lugar en ambos torneos.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_M%C3%A9xico',
        	'pais_id' => 3        	
        );   

        $equipos[] = array(
            'nombre' => 'Venezuela',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/004/original/venezuela.jpg', 
            'tipo' => 'selección',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'La Vinotinto',
            'ubicacion' => 'Venezuela',
            'historia' => 'La selección de fútbol de Venezuela, conocida como La Vinotinto, es el equipo representativo del país en las competiciones oficiales de fútbol. Su organización está a cargo de la Federación Venezolana de Fútbol desde 1926, afiliada a la Federación Internacional de Fútbol Asociación (FIFA) desde 19521 y a la Confederación Sudamericana de Fútbol (Conmebol) desde 1953,2 siendo la última de las diez federaciones suramericanas en formarse y afiliarse. Su debut se produjo el 12 de febrero de 1938 ante la selección de Panamá en los IV Juegos Centroamericanos y del Caribe de aquel año. Es el único equipo de la Conmebol que aún no ha clasificado a una Copa Mundial de Fútbol y es también uno de los pocos que no ha ganado la Copa América, junto a Chile y Ecuador. Histórica y estadísticamente ha sido considerada una de las selecciones más débiles de la confederación continental. Sin embargo, desde finales del siglo XX se inició un crecimiento futbolístico muy importante en Venezuela que se ha traducido en un mejoramiento notable de su competitividad y de la calidad de su juego.',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Venezuela',
            'pais_id' => 4          
        );   

        $equipos[] = array(
            'nombre' => 'España',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/005/original/espana.jpg', 
            'tipo' => 'selección',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'La Furia Española',
            'ubicacion' => 'España',
            'historia' => 'La selección de fútbol de España es el equipo formado por jugadores de nacionalidad española que representa a la Real Federación Española de Fútbol desde 1920 en las competiciones oficiales organizadas por la Unión de Asociaciones de Fútbol Europeas (UEFA) y la Federación Internacional de Fútbol Asociación (FIFA). El equipo es conocido familiarmente como «La Furia Española», rememorando el saqueo de Amberes, episodio de la historia militar española.2 También es conocido con el seudónimo «La Furia Roja», acuñado por un periodista italiano que se refirió a él como «Furia Rossa».3 En los últimos años se ha popularizado simplemente como «La Roja», término que acuñó el ex seleccionador nacional Luis Aragonés.1',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Espa%C3%B1a',
            'pais_id' => 5          
        );   
    
         $equipos[] = array(
            'nombre' => 'Colombia',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/006/original/colombia.jpg', 
            'tipo' => 'selección',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Cafeteros',
            'ubicacion' => 'Colombia',
            'historia' => 'La Selección de fútbol de Colombia es el equipo representativo de ese país para la práctica de este deporte, está dirigida por la Federación Colombiana de Fútbol (FCF), la cual está afiliada a la Confederación Sudamericana de Fútbol (CONMEBOL) y la Federación Internacional de Fútbol Asociado (FIFA), por lo que la selección participa en las competencias que estas entidades organizan. Su primer partido internacional lo disputó en la ciudad de Panamá el 10 de febrero de 1938. Su máximo logro internacional fue la Copa América obtenida en el año 2001, siendo sede de la misma. Dentro del torneo continental más antiguo, también ha alcanzado un subcampeonato en 1975 y la llegada a instancias semifinales en 1987, 1991, 1993, 1995 y 2004',
            'info_url' => 'http://es.wikipedia.org/wiki/Selecci%C3%B3n_de_f%C3%BAtbol_de_Colombia',
            'pais_id' => 6          
        );   

         $equipos[] = array(
            'nombre' => 'Aragua Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/007/original/aragua.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Aurirrojos',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Aragua Fútbol Club es un club de fútbol profesional con sede en la ciudad de Maracay, capital del estado Aragua. Fue fundado el 20 de agosto del 2002 por un grupo de empresarios aragüeños, ingresando en la Segunda División de Venezuela un año luego de la fundación del club.1 Participa en la Primera División de Venezuela desde el año 2005. El color que identifica al club es el amarillo y rojo, aunque en sus comienzos los colores insignias eran el blanco y azul. Disputa sus partidos como local en el Estadio Olímpico Hermanos Ghersi Páez de la ciudad de Maracay, que cuenta con una capacidad para 16.000 espectadores.',
            'info_url' => 'http://es.wikipedia.org/wiki/Aragua_F%C3%BAtbol_Club',
            'pais_id' => 4         
        );   

        $equipos[] = array(
            'nombre' => 'Atlético Venezuela Club de Fútbol',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/008/original/atletico.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'El Tricolor',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Atlético Venezuela Club de Fútbol es un equipo venezolano de fútbol que juega en la Primera División de Venezuela. Fue fundado en 2009. En tres años, ha logrado dos ascensos a Primera División y dos campeonatos de Segunda División.',
            'info_url' => 'http://es.wikipedia.org/wiki/Atl%C3%A9tico_Venezuela_Club_de_F%C3%BAtbol',
            'pais_id' => 4         
        );   

        $equipos[] = array(
            'nombre' => 'Carabobo Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/009/original/carabobo.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Vinotinto Regional',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Carabobo Fútbol Club es un club de fútbol venezolano de la ciudad de Valencia del estado Carabobo , Venezuela que participa en la Primera División de Venezuela . Fue fundado el 26 de febrero de 1997 luego de que el Valencia Fútbol Club de la misma ciudad diera un paso al costado y desapareciera. El equipo disputa sus partidos de local en el Polideportivo Misael Delgado ubicado en la Avenida Bolívar (Valencia).',
            'info_url' => 'http://es.wikipedia.org/wiki/Carabobo_F%C3%BAtbol_Club',
            'pais_id' => 4         
        );   

        $equipos[] = array(
            'nombre' => 'Caracas Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/010/original/caracas.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Los Rojos del Ávila',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Caraas Fútbol Club es un club de fútbol profesional con sede en la ciudad de Caracas, capital de Venezuela. Fundado el 12 de diciembre de 1967, por iniciativa de un grupo de aficionados, con la idea de tener un club de fútbol en el cual pudiesen distraerse en sus ratos libres. Posteriormente el conjunto fue registrado en la Asociación de Fútbol del estado Miranda como un equipo amateur, participando en la Primera División de Venezuela desde 1985. El color que identifica al club es el rojo. Disputa sus partidos como local en el Estadio Olímpico de la Universidad Central de Venezuela, que cuenta con una capacidad para 24.900 espectadores',
            'info_url' => 'http://es.wikipedia.org/wiki/Caracas_F%C3%BAtbol_Club',
            'pais_id' => 4         
        );   
        
        $equipos[] = array(
            'nombre' => 'Deportivo Anzoátegui Sport Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/011/original/anzoategui.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Danz',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Deportivo Anzoátegui Sport Club es un equipo de fútbol venezolano fundado en 2002, tiene su base en la ciudad de Puerto La Cruz en el Estado Anzoátegui. Juega de local en el Estadio José Antonio Anzoátegui y actualmente milita en la Primera División de Venezuela. El título más importante que ha conseguido en su corta historia es la Copa Venezuela 2008 con la que consiguió el pase a la Copa Sudamericana 2009, también ha logrado los títulos de Copa Venezuela 2012 y Torneo Apertura 2012 logrando ser el primer equipo venezolano al lograr este doblete, alcanzando así también su pase a la Copa Sudamericana 2013 y Copa Libertadores 2014, respectivamente. Debutó internacionalmente el 29 de enero de 2009 en la fase previa de la Copa Libertadores 2009 frente al Deportivo Cuenca con resultado a favor de 2 a 0. El Deportivo Anzoátegui se convirtió en el primer equipo venezolano en participar 2 copas internacionales en un solo año. (Copa Libertadores y Copa Sudamericana en el año 2009).',
            'info_url' => 'http://es.wikipedia.org/wiki/Deportivo_Anzo%C3%A1tegui_Sport_Club',
            'pais_id' => 4         
        );   

        $equipos[] = array(
            'nombre' => 'Club Deportivo Lara',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/012/original/lara.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Danz',
            'ubicacion' => 'Venezuela',
            'historia' => '| continental = Copa Sudamericana | temporada3 = 2013 | posición3 = Primera Fase | títulos3 = número de títulos (este parámetro solo funciona si se añade el parámetro "último3") }} La Asociación Civil Deportivo Lara, es un club de fútbol venezolano establecido en la ciudad de Cabudare, Estado Lara, que actualmente juega en la Primera División de Venezuela y disputa sus partidos de local en el Estadio Metropolitano de Cabudare ubicado en el municipio Palavecino que forma parte del Área Metropolitana de la ciudad de Barquisimeto. Fundado el 2 de julio de 2009, el equipo ha logrado participar en dos copas internacionales y ha ganado una vez el trofeo de la Primera División de Venezuela.',
            'info_url' => 'http://es.wikipedia.org/wiki/Club_Deportivo_Lara',
            'pais_id' => 4         
        );   
        
         $equipos[] = array(
            'nombre' => 'Deportivo La Guaira',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/013/original/guaira.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Equipo de la costa',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Deportivo La Guaira es un equipo de fútbol de la ciudad de La Guaira, estado Vargas, aunque juega sus encuentros en la ciudad de Caracas, por no poseer aún una estructura deportiva acorde para la práctica de fútbol. Su sede es el estadio Olímpico de la UCV.',
            'info_url' => 'http://es.wikipedia.org/wiki/Deportivo_La_Guaira',
            'pais_id' => 4         
        );

        $equipos[] = array(
            'nombre' => 'Deportivo Petare Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/014/original/petare.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Los Parroquiales',
            'ubicacion' => 'Venezuela',
            'historia' => 'Deportivo Petare Fútbol Club es un equipo de fútbol venezolano establecido en la ciudad de Caracas, que actualmente juega en la Primera División de Venezuela. Fue fundado el 18 de agosto de 1948 en Caracas bajo el nombre Deportivo Italia, pero se ha transferido en 2010 a la parroquia de Petare, en el estado Miranda, cuando su nombre fue cambiado por "Deportivo Petare" el 20 de julio de 2010. Juega en el Estadio Olímpico de la UCV. Es considerado -cuando era llamado "Deportivo Italia"- como el mejor equipo venezolano del siglo XX (junto al Estudiantes de Mérida), según la IFFHS.1',
            'info_url' => 'http://es.wikipedia.org/wiki/Deportivo_Petare_F%C3%BAtbol_Club',
            'pais_id' => 4         
        );   

         $equipos[] = array(
            'nombre' => 'Deportivo Táchira Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/015/original/tachira.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'Los Aurinegros',
            'ubicacion' => 'Venezuela',
            'historia' => 'El Deportivo Táchira Fútbol Club, es una institución deportiva de la ciudad de San Cristóbal, Venezuela y su actividad principal es el fútbol profesional. Es uno de los clubes más populares de Venezuela.3 Fue fundado el 11 de enero de 1974, por iniciativa de Gaetano Greco,4 con el nombre de San Cristóbal Fútbol Club. Disputa sus encuentros de local en el Polideportivo de Pueblo Nuevo, que cuenta con una capacidad para 42.500 espectadores.2 A nivel internacional, es el equipo venezolano con más participaciones en la Copa Libertadores de América.5 Su mejor participación internacional fue avanzar a cuartos de final de forma invicta en la Copa Libertadores 2004.6',
            'info_url' => 'http://es.wikipedia.org/wiki/Deportivo_T%C3%A1chira_F%C3%BAtbol_Club',
            'pais_id' => 4         
        );  

        $equipos[] = array(
            'nombre' => 'Estudiantes de Mérida Fútbol Club',
            'escudo' => null,
            'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => 'El Rojiblanco',
            'ubicacion' => 'Venezuela',
            'historia' => 'Estudiantes de Mérida Fútbol Club, conocido comúnmente como Estudiantes, es un equipo de fútbol profesional de Venezuela. Es uno de los conjuntos más antiguos dentro del balompié profesional de ese país y miembro de la Federación Venezolana de Fútbol y establecido en la ciudad andina de Mérida. El mismo es de reconocida trayectoria nacional e internacional, habiendo participado en eventos internacionales como la Copa Libertadores de América, Copa Sudamericana, Copa Simón Bolívar, Copa Conmebol y Copa Merconorte, así como también ha ganado varios campeonatos de ámbito regional y nacional durante su historia. Fue considerado el mejor equipo venezolano del siglo XX según la IFFHS.,1 jugando un partido amistoso contra el "Real Madrid" empatando a 2 goles',
            'info_url' => 'http://es.wikipedia.org/wiki/Estudiantes_de_M%C3%A9rida_F%C3%BAtbol_Club',
            'pais_id' => 4         
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