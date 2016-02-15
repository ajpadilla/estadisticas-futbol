<?php

use soccer\Competition\CompetitionRepository;
use Carbon\Carbon;

class PublicController extends \BaseController {

	protected $competitionRepository;

	public function __construct(CompetitionRepository $competitionRepository) {
		$this->competitionRepository = $competitionRepository;
	}

	/**
	 * Display a listing of the resource.
	 * Muestra los partidos del dia actual
	 *
	 * @return Response
	 */
	public function index()
	{
		$showToday = true;

		$tomorrow = Carbon::tomorrow()->formatLocalized('%Y-%m-%d');
		$today = ucwords (Carbon::today()->formatLocalized('%A %d %B %Y'));
		$yesterday = Carbon::yesterday()->formatLocalized('%Y-%m-%d');

		$competitions = $this->competitionRepository->getAll();
	 	 return View::make('public.home', compact('competitions','today','showToday'));
	}

	/*
		Muestra los partidos por dias (Ayer, Mañana)
	 */
	public function gamesIndex($day)
	{
		$showTomorrow = false;
		$showYesterday = false;
		$view = null;
		$date = null;

		$tomorrow = Carbon::tomorrow()->formatLocalized('%Y-%m-%d');
		$yesterday = Carbon::yesterday()->formatLocalized('%Y-%m-%d');

		$competitions = $this->competitionRepository->getAll();

	 	switch ($day) {
	 		case "tomorrow":
	 			$showTomorrow = true;
	 			$date = Carbon::tomorrow();
	 			$view = View::make('public.home', compact('competitions','date','showTomorrow','showYesterday'));
	 			break;
	 		case "yesterday":
	 			$showYesterday = true;
	 			$date = Carbon::yesterday();
	 			$view = View::make('public.home', compact('competitions','date','showTomorrow','showYesterday'));
	 			break;
	 	}
	 	return $view;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function gamesFirstDivision()
	{


		$competitions = $this->competitionRepository
		->getModel()
		->whereType('primera')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;

	 	return View::make('public.primera._primera', compact('competitions', 'competitionRepository'));
	}

	public function positionsteamsForCompetitions()
	{
		$groupsFixtures = $this->competitionRepository->positionsTeamsForTournament(Input::get('id'));
		$this->setSuccess(($groupsFixtures ? true : false));
		$this->addToResponseArray('groupsFixtures', $groupsFixtures);
		$this->addToResponseArray('numberGroups', count($groupsFixtures));
		return $this->getResponseArrayJson();
	}

	public function gamesForPhase()
	{
		$gamesFixtures = $this->competitionRepository
		->getGamesForPhase(Input::get('phaseId'));

		$statsPhase = $this->competitionRepository->statsPhase(Input::get('phaseId'));

		$infoCompetition = $this->competitionRepository
		->getNameForCompetitionAndPhase(Input::get('phaseId'), Input::get('competitionId'));

		$this->setSuccess(true);
		$this->addToResponseArray('infoCompetition', $infoCompetition);
		$this->addToResponseArray('gamesFixtures', $gamesFixtures);
		$this->addToResponseArray('statsPhase', $statsPhase);
		return $this->getResponseArrayJson();
	}

	public function getScorersGoalsFormCompetition()
	{
		$scoredGoals = $this->competitionRepository->scorersInCompetition(Input::get('id'));
		$this->setSuccess(true);
		$this->addToResponseArray('scoredGoals', $scoredGoals);
		return $this->getResponseArrayJson();
	}

	public function getCurrentCompetition()
	{
		Session::put('currentCompetitionId', Input::get('competitionId'));
		$currentCompetitionId =  Session::get('currentCompetitionId');
		$this->setSuccess(true);
		$this->addToResponseArray('currentCompetitionId', $currentCompetitionId);
		return $this->getResponseArrayJson();
	}

	public function gamesForWorldCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$hasGamesCurrentCup = null;

		$cups = $this->competitionRepository
		->getModel()
		->whereType('copa mundial')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($cups) >0 )
			foreach ($cups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			$hasGamesCurrentCup = $currentCup->hasGames;
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$scoredGoals = $this->competitionRepository->scorersInCompetition($currentCup->id);
		}
	 	return View::make('public.mundial._mundial', compact(
	 													'cups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'scoredGoals'
	 												)
	 	);

	}

	public function gamesForAmericaCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;

		$americaCups = $this->competitionRepository
		->getModel()
		->whereType('copa america')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($americaCups) >0 )
			foreach ($americaCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.copa_america._copa_america', compact(
	 													'americaCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function gamesForLibertadoresCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;
		
		$libertadoresCups = $this->competitionRepository
		->getModel()
		->whereType('copa libertadores')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($libertadoresCups) >0 )
			foreach ($libertadoresCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.libertadores._libertadores', compact(
	 													'libertadoresCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function gamesForChampionsCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;
		
		$championsCups = $this->competitionRepository
		->getModel()
		->whereType('champion L')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($championsCups) >0 )
			foreach ($championsCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.champions._champions', compact(
	 													'championsCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function gamesForArgentinaCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;
		
		$argentinaCups = $this->competitionRepository
		->getModel()
		->whereType('copa argentina')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($argentinaCups) >0 )
			foreach ($argentinaCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.copa_argentina._copa_argentina', compact(
	 													'argentinaCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function gamesForSudamericanaCup()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;
		
		$sudamericanaCups = $this->competitionRepository
		->getModel()
		->whereType('sudamericana')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($sudamericanaCups) >0 )
			foreach ($sudamericanaCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.sudamericana._sudamericana', compact(
	 													'sudamericanaCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function gamesForMundialClubes()
	{
		$currentCup = null;
		$gamesForPhases = [];
		$scoredGoals = null;
		$tablePosTeams = null;
		$firstPhase = null;
		$winner = null;
		$gamesOctavos = null;
		$gamesCuartos = null;
		$gamesSemiFinal = null;
		$gamesFinal = null;
		
		$mundialClubesCups = $this->competitionRepository
		->getModel()
		->whereType('mundial de clubes')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);

		if(count($mundialClubesCups) >0 )
			foreach ($mundialClubesCups as $cup)
				$currentCup = $this->competitionRepository->get($cup->id);

		if(!empty($currentCup))
		{
			foreach ($currentCup->phases as $phase) {
				$gamesForPhases[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
			}

			if($currentCup->hasPhases)
			{
				$firstPhase = $currentCup->phases->first();
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->from, $currentCup->to);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->from, $currentCup->to);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->from, $currentCup->to);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->from, $currentCup->to);
		}
	 	return View::make('public.mundial_clubes.mundial_clubes', compact(
	 													'mundialClubesCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesOctavos',
	 													'gamesCuartos',
	 													'gamesSemiFinal',
	 													'gamesFinal'
	 												)
	 	);
	}

	public function getCompetitionsForCurrentAverage()
	{
		
		$competition = $this->competitionRepository->get(Input::get('competitionId'));
		$dates  = [];
		$dateSeason3 = 0;
		$dateSeason2 = 0;
		$dateSeason1 = 0;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType($competition->type)
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->where('desde','<=', $competition->desde)
		->where('hasta','<=', $competition->hasta)
		->take(6)
		->get();

		foreach ($competitions as $competition) {
			$dates[] = $competition->year;
		}

		if(count($competitions) > 0)
			$averages = $this->competitionRepository->getAverage($competitions, $competition);

		$this->setSuccess(($averages ? true : false));
		$this->addToResponseArray('averages', $averages);
		$this->addToResponseArray('dates', $dates);
		return $this->getResponseArrayJson();
	}

}
