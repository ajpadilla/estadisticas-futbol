<?php namespace soccer\Competition\Phase;

use soccer\Base\BaseRepository;
use soccer\Group\GroupRepository;
use soccer\Competition\Phase\Phase;
use soccer\Equipo\EquipoRepository;
use Carbon\Carbon;

/**
* 
*/
class PhaseRepository extends BaseRepository
{

	function __construct() {
		$this->columns = [];
		$this->setModel(new Phase);
	}

	/*
	********************* Methods ***********************
    */

	public function create($data = array())
	{
		if (empty($data['from'])) {
			$data['from'] = 0000-00-00;
		}

		if (empty($data['to'])) {
			$data['to'] = 0000-00-00;
		}

		$phase = $this->model->create($data); 
		return $phase;
	}

	public function getAvailableTeamsForGroup($id, $forList = true)
	{
		$equipoRepository = new EquipoRepository;
		$phase = $this->get($id);
		$teams = [];
		if($phase->groups->count()) {
			$groupRepository = new GroupRepository;
			$excludeTeams = [];
			foreach ($phase->groups as $group)
				foreach ($group->teams as $team) 
					$excludeTeams[] = $team->id;

			if($phase->competition->international) 
				$availableTeams = $equipoRepository->getAll($excludeTeams);
			else
				$availableTeams = $equipoRepository->getByCountry($phase->competition->country, $excludeTeams);				

		    if(count($availableTeams))
		    	foreach ($availableTeams as $team) 
		    		$teams[] = $team;
		} else {
			$teams = $phase->competition
						   ->country
						   ->teams()
						   ->clubes()
						   ->get();
		}
		if($teams && count($teams)) {
			$tmpTeams = [];
			foreach ($teams as $team) 
				$tmpTeams[] = ['id' => $team->id, 'name' => $team->nombre];
		}
		return empty($tmpTeams) ? false : array_unique($tmpTeams, SORT_REGULAR);
	}	
}
