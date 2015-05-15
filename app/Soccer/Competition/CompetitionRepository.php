<?php namespace soccer\Competition;

use soccer\Base\BaseRepository;
use soccer\Group\GroupRepository;
use soccer\Competition\Competition;
/**
* 
*/
class CompetitionRepository extends BaseRepository
{		
	
	function __construct() {
		$this->columns = [
			'Nombre',
			'Inicia',
			'Finaliza',
			'Tipo de competencia',
			'Acciones'
		];

		$this->setModel(new Competition);
		$this->setListAllRoute('competitions.api.list');
	}
    /*
	********************* Methods ***********************
    */
    	

	public function create($data = array())
	{
		if (empty($data['pais_id'])) {
			$data['pais_id'] = NULL;
		}
		$competencia = $this->model->create($data); 
		return $competencia;
	}

	public function addGroup($id, $group, $teams = null)
	{
		$competition = $this->get($id);
		$groupRepository = new GroupRepository;
		$group['competition_id'] = $competition->id;
		$group = $groupRepository->create($group);			
		
		/*if(!$teams && isset($group['teams_ids'])) {
			$teams = $group['teams_ids'];
		}*/

		/*if($group) {
			if($competition->teamsByGroup < count($teams))
				$teams = array_slice($teams, 0, $competition->teamsByGroup);
			$group->attach($teams);
		}*/
		return $group;
	}

	public function getAvailableTeams($id)
	{
		$competition = $this->get($id);
		if($competition->groups->count()) {
			$groupRepository = new GroupRepository;
			$teams = array();
			foreach ($competition->with('groups') as $group)
			{
			    $availableTeams = $groupRepository->getAvailableTeams($group->id);
			    if($availableTeams->count())
			    	foreach ($availableTeams as $team) 
			    		$teams[] = $team;
			}
			return empty($teams) ? false : $teams;
		}
		return false;
	}

    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-competition' href='" . route('competitions.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a class='delete-competition' href='#' id='delete_competition_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Inicia', 'Finaliza', 'Tipo de competencia');
		$this->collection->orderColumns('Nombre', 'Inicia', 'Finaliza', 'Tipo de competencia');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Inicia', function($model)
		{
			 return $model->desde;
		});

		$this->collection->addColumn('Finaliza', function($model)
		{
			 return $model->hasta;
		});

		$this->collection->addColumn('Tipo de competencia', function($model)
		{
			 return $model->tipoCompetencia->nombre;
		});
	}		

	public function getGroupTables($id)
	{		
		$competition = $this->get($id);
		$tables = array();		
		if(!$competition->isClean) {
			$groupRepository = new GroupRepository;			
			$orderColumn = $groupRepository->getColumnCount() - 1;
			foreach ($competition->groups as $group) 
				$tables[] = $groupRepository->getAllTable('groups.api.list.group', [$group->id], $orderColumn, 'desc', $group->id);			
		}
		return $tables;
	}
}