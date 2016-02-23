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
        	'tipo' => 'club',
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

         $equipos[] = array(
            'nombre' => 'Villa Dalmine',
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
            'nombre' => 'Ctral Cordoba',
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
            'nombre' => 'Los Andes',
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
            'nombre' => 'Brasil',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Brasil',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Croacia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Croacia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Mexico',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Mexico',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Camerun',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Camerun',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Espana',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Espana',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Holanda',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Holanda',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Chile',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Chile',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Australia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Australia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Colombia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Colombia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Grecia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Grecia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Costa de marfil',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Costa de marfil',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Japon',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Japon',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Uruguay',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Uruguay',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Costa rica',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Costa rica',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Inglaterra',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Inglaterra',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Italia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Italia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Suiza',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Suiza',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Ecuador',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Ecuador',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Francia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Francia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Honduras',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Honduras',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Argentina',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argentina',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Bosnia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Bosnia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Iran',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Iran',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Nigeria',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Nigeria',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Alemania',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Alemania',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Portugal',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Portugal',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Ghana',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Ghana',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'USA',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'USA',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Belgica',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Belgica',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Argelia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Argelia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Rusia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Rusia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Corea del sur',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Corea del sur',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Bolivia',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Bolivia',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Paraguay',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Paraguay',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Jamaica',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Jamaica',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Venezuela',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Venezuela',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Alianza Lima',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Alianza Lima',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Dep Tachira',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Dep Tachira',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Cerro Porteno',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Cerro Porteno',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Palestino',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Palestino',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Nacional',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Nacional',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Ind del Valle (E)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Ind del Valle (E)',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Monarca',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Monarca',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'The Strongest',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'The Strongest',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Corinthians',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Corinthians',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Once Caldas',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Once Caldas',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Santa Fe',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Santa Fe',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Alt Mineiros',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Alt Mineiros',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Colo Colo',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Colo Colo',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Atlas',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Atlas',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Sao Paulo',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Sao Paulo',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Danubio',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Danubio',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Cruzeiro',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Cruzeiro',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'universitario',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'universitario',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Mineros',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Mineros',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

         $equipos[] = array(
            'nombre' => 'Internacional',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Internacional',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Emelec',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Emelec',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


         $equipos[] = array(
            'nombre' => 'Wanderers',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Wanderers',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Zamora',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Zamora',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Tigres',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Tigres',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Juan Aurich',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Juan Aurich',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'San Jose (B)',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'San Jose (B)',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Libertad',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Libertad',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Barcelona',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Barcelona',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );

        $equipos[] = array(
            'nombre' => 'Guarani',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Guarani',
            'historia' => '',
            'info_url' => '',
            'pais_id' => 3         
        );


        $equipos[] = array(
            'nombre' => 'Sp Cristal',
            //'escudo' => 'public/system/soccer/Equipo/Equipo/escudos/000/000/016/original/merida.jpg',
            //'foto' => 'public/system/soccer/Equipo/Equipo/fotos/000/000/016/original/merida.jpg', 
            'tipo' => 'seleccion',
            'fecha_fundacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'apodo' => '',
            'ubicacion' => 'Sp Cristal',
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