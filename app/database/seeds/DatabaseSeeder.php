<?php

class DatabaseSeeder extends Seeder {

	protected $faker;

	public function getFaker()
	{
		if (empty($this->faker))
		{
			$faker = Faker\Factory::create();
			$faker->addProvider(new Faker\Provider\Base($faker));
			$faker->addProvider(new Faker\Provider\Lorem($faker));
		}
		return $this->faker = $faker;
	}


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PosicionesTableSeeder');
		$this->call('PaisesTableSeeder');
		$this->call('PlayersTableSeeder');
		$this->call('EquiposTableSeeder');
		$this->call('PosicionJugadorTableSeeder');
		$this->call('TiposCompetenciaTableSeeder');
		$this->call('CompetitionsTableSeeder');
		$this->call('GroupsTableSeeder');
		$this->call('GroupTeamTableSeeder');
		//$this->call('UserTableSeeder');
	}

}
