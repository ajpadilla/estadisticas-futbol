<?php namespace soccer\Competition\Phase;

use soccer\Base\BaseRepository;
use soccer\Group\GroupRepository;
use soccer\Competition\Phase\Phase;
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

	public function getAvailableTeams($id, $forList = true)
	{
		$phase = $this->get($id);
		if($phase->groups->count()) {
			$groupRepository = new GroupRepository;
			$teams = array();
			foreach ($phase->groups as $group)
			{
			    $availableTeams = $groupRepository->getAvailableTeams($group->id, $forList);
			    if(count($availableTeams))
			    	foreach ($availableTeams as $team) 
			    		$teams[] = $team;
			}
			return empty($teams) ? false : array_unique($teams, SORT_REGULAR);
		}
		return false;
	}	
}
