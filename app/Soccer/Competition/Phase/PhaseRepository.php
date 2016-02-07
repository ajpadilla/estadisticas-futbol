<?php namespace soccer\Competition\Phase;

use Faker\Provider\tr_TR\DateTime;
use Illuminate\Database\Eloquent\Collection;
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
			$lastPhase = $this->get($competitionRepository->lastPhase($data['competition_id'])->id);
			if($lastPhase->last)
				return false;
			$data['previous_id'] = $lastPhase->id;
		}
		$phase = $this->model->create($data);
		return $phase;
	}

	public function finished($id)
	{
		return $this->get($id)->finished;
	}

	public function classifieds($id)
	{
		$teams = new Collection;
		$phase = $this->get($id);
		$classifiedTeamsQty = $phase->format->clasificated_by_group;
		if($phase->hasGroups) {
			$groupRepository = new GroupRepository;
			$equipoRepository = new EquipoRepository;
			foreach ($phase->groups as $group) {
				$teamsFixtures = $groupRepository->getOrderedFixturesArrayByGroup($group->id);
				$i = 0;
				while ((list($key, $team) = each($teamsFixtures)) && $i < $classifiedTeamsQty) {
					$team = $equipoRepository->get($team['id']);
					$teams->add($team);
					$i++;
				}
			}
		}
		return $teams;
	}

	public function winner($id)
	{
		return $this->classifieds($id)->first();
	}

	public function getAvailableTeamsForGroup($id, $forList = true)
	{
		$phase = $this->get($id);
		$teams = [];

		if($phase->previous) {
			$previousPhase = $phase->previous;
			if ($this->finished($previousPhase->id))
				$teams = $this->classifieds($previousPhase->id);
		} else {
			if ($phase->competition->international) {
				$equipoRepository = new EquipoRepository;
				$teams = $equipoRepository->getAll();
			} else {
				$teams = $phase->competition
					->country
					->teams()
					->clubes()
					->get();
			}
		}
		if($phase->hasGroups) {
			$excludeTeams = [];
			foreach ($phase->groups as $group)
				$excludeTeams = array_merge($excludeTeams, $group->teams->lists('id'));

			if (count($excludeTeams)) {
				$excludeTeamsKeys = [];

				foreach ($teams as $k => $team)
					if(array_search($team->id, $excludeTeams) !== FALSE)
						$excludeTeamsKeys[] = $k;

				foreach ($excludeTeamsKeys as $k)
					unset($teams[$k]);
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
