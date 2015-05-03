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
		$this->call('JugadoresTableSeeder');
		$this->call('EquiposTableSeeder');
		$this->call('PosicionJugadorTableSeeder');
		$this->call('TiposCompetenciaTableSeeder');
		$this->call('CompetenciasTableSeeder');
		//$this->call('UserTableSeeder');
	}

}
