<?php

use soccer\Equipo\Equipo;
use soccer\Player\Player;


class EquiposTableSeeder extends DatabaseSeeder {

	public function run()
	{
        $faker = $this->getFaker();

        $equipos = array();
        
        $equipos[] = array(
        	'nombre' => 'Boca Juniors',
        	//'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/015/original/Aldosivi.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/015/original/Aldosivi_foto.jpg', 
        	'tipo' => 'Club',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => '',
        	'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
        	'pais_id' => 3        	
        );

        $equipos[] = array(
        	'nombre' => 'San Lorenzo',
        	//'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/002/original/brasil.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/002/original/brazil.jpg',
        	'tipo' => 'club',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => '',
        	'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
        	'pais_id' => 3       	
        );

        $equipos[] = array(
        	'nombre' => 'Rosario Central',
        	//'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/003/original/argentina.png',
            ////'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/003/original/argentina.jpg', 
        	'tipo' => 'club',
        	'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        	'apodo' => '',
        	'ubicacion' => 'Argentina',
            'historia' => '', 
            'info_url' => '',
        	'pais_id' => 3        	
        );   

        $equipos[] = array(
            'nombre' => 'Racing Club',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/004/original/venezuela.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/004/original/venezuela.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '', 
            'info_url' => '',
            'pais_id' => 3          
        );   

        $equipos[] = array(
            'nombre' => 'Independiente',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/005/original/espana.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/005/original/espana.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => '',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3          
        );   
    
         $equipos[] = array(
            'nombre' => 'Belgrano',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/006/original/colombia.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/006/original/colombia.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3          
        );   

         $equipos[] = array(
            'nombre' => 'Estudiantes (LP)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/007/original/aragua.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/007/original/aragua.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3        
        );   

        $equipos[] = array(
            'nombre' => 'Banfield',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/008/original/atletico_venezuela.png',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/008/original/atletico.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '', 
            'info_url' => '',
            'pais_id' => 3        
        );   

        $equipos[] = array(
            'nombre' => 'River Plate',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/009/original/carabobo.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/009/original/carabobo.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3        
        );   

        $equipos[] = array(
            'nombre' => 'Tigre',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/010/original/caracas.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/010/original/caracas.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );   
        
        $equipos[] = array(
            'nombre' => 'Quilmes',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/011/original/anzoategui.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/011/original/anzoategui.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );   

        $equipos[] = array(
            'nombre' => 'Gimnasia (LP)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/012/original/lara.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/012/original/lara.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => 'http://es.wikipedia.org/wiki/Club_Deportivo_Lara',
            'pais_id' => 3         
        );   
        
         $equipos[] = array(
            'nombre' => 'Lanus',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/013/original/la_guaira.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/013/original/guaira.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => '',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Union',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/014/original/petare.png',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/014/original/petare.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );   

         $equipos[] = array(
            'nombre' => 'Aldosivi',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/015/original/tachira.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/015/original/tachira.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );  

        $equipos[] = array(
            'nombre' => 'Newells',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'San Martin (SJ)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Olimpo',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Colon',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Argentinos',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Def y Justicia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Godoy Cruz',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Huracan',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Sarmiento (J)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Temperley',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Nueva Chicago',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Velez',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Arsenal',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Atl Rafaela',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Crucero (M)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'club',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        foreach ($equipos as $equipo) {
            Equipo::create($equipo);
        }

        $players = array_chunk(Player::all()->lists('id'), 15);
        $equipos = Equipo::all();
        $i = 0;
        foreach ($equipos as $equipo) {
            $equipo->jugadores()->attach($players[$i]);
            $i++;
        }
	}
}