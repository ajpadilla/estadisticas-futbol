<?php

/**
*
*/
class CompetitionsTableSeeder extends DatabaseSeeder{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $competitions[] = array(
        	'nombre' => 'La Liga',
        	'desde' => '2015-10-20',
        	'hasta' => '2016-05-20',
            'country_id' => 5,
            'competition_format_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')
        );

        $competitions[] = array(
            'nombre' => 'Torneito local',
            'desde' => '2015-10-20',
            'hasta' => '2016-05-20',
            'country_id' => 5,
            'competition_format_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')
        );

        $competitions[] = array(
            'nombre' => 'Torneito local',
            'desde' => '2015-07-20',
            'hasta' => '2016-09-20',
            'country_id' => 4,
            'competition_format_id' => 4,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')
        );

        $competitions[] = array(
            'nombre' => 'Copa Venezuela 2015',
            'desde' => '2015-07-20',
            'hasta' => '2016-09-20',
            'country_id' => 4,
            'competition_format_id' => 4,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')
        );

        DB::table('competitions')->insert($competitions);
	}

}