<?php namespace soccer\Competition\Phase;

use soccer\Base\BaseRepository;
use soccer\Competition\CompetitionRepository;
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
		$competitionRepository = new CompetitionRepository;
		if(!$competitionRepository->isEmpty($data['competition_id'])) {
			$lastPhase = $competitionRepository->get($competitionRepository->lastPhase($data['competition_id'])->id);
			if($lastPhase->last)
				return false;
			$data['previous_id'] = $competitionRepository->lastPhase($data['competition_id'])->id;
		}
		$phase = $this->model->create($data);
		return $phase;
	}

	public function getAvailableTeamsForGroup($id, $forList = true)
	{
		$equipoRepository = new EquipoRepository;
		$phase = $this->get($id);
		$teams = [];

		if($phase->previous) {
			$previousPhase = $phase->previous;
			if ($previousPhase->finished) {
				$phaseRepository = new PhaseRepository;
				$teams = $phaseRepository->classifieds;
			}
		} else {
			if ($phase->competition->internationl) {
				$teams = $equipoRepository->getAll();
			} else {
				$teams = $phase->competition
					->country
					->teams()
					->clubes()
					->get();
			}
		}

		if($phase->groups->count()) {
			$groupRepository = new GroupRepository;
			$excludeTeams = [];
			foreach ($phase->groups as $group)
				foreach ($group->teams as $team) 
					$excludeTeams[] = $team->id;

			if (count($excludeTeams)) {
				$excludeTeamsKeys = [];
				foreach ($teams as $k => $team)
					if(array_search($team->id, $excludeTeams))
						$excludeTeamsKeys[] = $k;
				$teams =  array_diff_key($teams, $excludeTeamsKeys);
			}
		}

		if($teams && count($teams)) {
			$tmpTeams = [];
			foreach ($teams as $team) 
				$tmpTeams[] = ['id' => $team->id, 'name' => $team->nombre];
		}
		return empty($tmpTeams) ? false : array_unique($tmpTeams, SORT_REGULAR);
	}	
}
