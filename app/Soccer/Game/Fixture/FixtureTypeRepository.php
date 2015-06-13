<?php namespace soccer\Game\Fixture;

use soccer\Game\Fixture\FixtureType;
use soccer\Base\BaseRepository;
use soccer\Game\GameRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class FixtureTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = ['Nombre', 'Acciones'];

		$this->setModel(new FixtureType);
		$this->setListAllRoute('');
	}

	public function getForGame($gameId)
	{
		$gameRepository = new GameRepository;
		$game = $gameRepository->get($gameId);
		$fixtureTypes = $this->getAllForSelect();		
		if($game) {			
			foreach ($fixtureTypes as $typeId => $type) {
				$check = (boolean)$game->fixtures->filter(function($fixture) use ($typeId) {
									if ($fixture->type_id == $typeId) return true;
								})->count();
				$type = array('type' => $type);
				if($check)
					$type['check'] = $check;
				$fixtureTypes[$typeId] = $type;
			}	
		}
		return $fixtureTypes;	
	}

/*
	*********************** DATATABLE SETTINGS ******************************
*/			


	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-sanction-type' href='#edit-sanction-type-form' id='edit_sanction-type_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-sanction-type' href='#' id='delete_sanction-type_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->name;
		});
	}	

	
}