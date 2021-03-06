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
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForLiguillas = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [] ;
		$dates_reverse = [];
		$averages = null;
		$statisticsTournament = [];

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('primera')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition){
				$currentCompetition = $competition;
				$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);
			}

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}

			$statisticsTournament = $this->competitionRepository->statisticsTournament($currentCompetition->id);
		}
		//dd($statisticsTournament);
		return View::make('public.primera._primera', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse',
				'averages', 
				'winner',
				'associatedCompetitions',
				'gamesForAssociateCompetitions',
				'statisticsTournament'
			)
		);
	}

	public function gamesBNacional()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('b nacional')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
			
		return View::make('public.b_nacional._b_nacional', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
	}

	public function gamesBMetro()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('b metro')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
		return View::make('public.b_metro._b_metro', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
	}

	public function gamesFederalA()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('federal a')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
		return View::make('public.federal_a._federal_a', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
	}

	public function gamesPrimeraC()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('primera c')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
		return View::make('public.primera_c._primera_c', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
	}

	public function gamesPrimeraD()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('primera d')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
		return View::make('public.primera_d._primera_d', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
	}


	public function gamesFederalB()
	{
		$currentCompetition = null;
		$winner = null;
		$liguillas = null;
		$gamesForAssociateCompetitions = [];
		$competitionsForAverage = null;
		$competitions = null;
		$dates = [];
		$dates_reverse = [];
		$averages = null;

		$competitions = $this->competitionRepository
		->getModel()
		->whereType('federal b')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->paginate(1);

		if(count($competitions) > 0)
		{
			foreach ($competitions as $competition)
				$currentCompetition = $competition;

			$competitionsForAverage  = $this->competitionRepository->getCompetitionsForCurrentAverage($currentCompetition->id);

			foreach ($competitionsForAverage as $competitionForAverage) {
				$dates[] = $competitionForAverage->year;
			}
			$dates_reverse = array_reverse($dates, true);
			$averages = $this->competitionRepository->getAverage($competitionsForAverage, $currentCompetition);
			$winner = $this->competitionRepository->winner($currentCompetition->id);

			$associatedCompetitions = $this->competitionRepository
			->getModel()
			->wherePreviousId($currentCompetition->id)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->get();

			foreach ($associatedCompetitions as $indexCompetition => $associatedCompetition) {
				foreach ($associatedCompetition->phases as $indexPhase => $phase) {
					$gamesForAssociateCompetitions[$phase->id] = $this->competitionRepository->getGamesForPhase($phase->id);
				}
			}
		}
		return View::make('public.federal_a._federal_a', 
			compact('competitions',
				'currentCompetition',
				'dates_reverse', 
				'averages', 
				'winner', 
				'associatedCompetitions',
				'gamesForAssociateCompetitions'
			)
		);
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
		$gamesForGroups = null;
		$gamesOctavos = null;
		$gamesCuartos = [];
		$gamesSemiFinal = null;
		$gamesFinal = null;

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
						$tablePosTeams[$group->id] = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
			$thirdPlace = $this->competitionRepository->getGamesForTypePhase('tercer lugar', $currentCup->id);
			$scoredGoals = $this->competitionRepository->scorersInCompetition($currentCup->id);
		}
		return View::make('public.mundial._mundial', compact(
			'cups',
			'currentCup',
			'gamesForPhases',
			'tablePosTeams',
			'gamesForGroups',
			'scoredGoals',
			'gamesOctavos',
			'gamesCuartos',
			'gamesSemiFinal',
			'gamesFinal',
			'thirdPlace'
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
		$thirdPlace = null;

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
						$tablePosTeams[$group->id] = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
			$thirdPlace = $this->competitionRepository->getGamesForTypePhase('tercer lugar', $currentCup->id);
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
			'gamesFinal',
			'thirdPlace'
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
		$thirdPlace = null;
		$repechajeCompetition = null;
		$firstPhaseRepechaje = null;
		$gamesForRepechaje = null;

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
				$firstPhase = $currentCup->phases()->whereType('fase de grupos')->first();;
				if(!empty($firstPhase) && !empty($firstPhase->hasGroups)){
					$gamesForGroups = $this->competitionRepository->getGamesForPhase($firstPhase->id);
					foreach ($firstPhase->groups as $group) {
						$tablePosTeams[$group->id] = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}

			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);

			$repechajeCompetition = $this->competitionRepository
			->getModel()
			->whereType('repechaje')
			->wherePreviousId($currentCup->id)
			->first();

			if(!empty($repechajeCompetition))
				$firstPhaseRepechaje = $repechajeCompetition->phases()->first();
				if(!empty($firstPhaseRepechaje) && !empty($firstPhaseRepechaje->hasGroups)){
					$gamesForRepechaje = $this->competitionRepository->getGamesForPhase($firstPhaseRepechaje->id);
				}

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
	 													'gamesFinal',
	 													'firstPhaseRepechaje',
	 													'gamesForRepechaje'
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
						$tablePosTeams[$group->id] = $this->competitionRepository->getPostTeamsForGruop($group->id);
					}
				}
			}
			$winner= $this->competitionRepository->winner($currentCup->id);
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
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
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
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
			$gamesOctavos = $this->competitionRepository->getGamesForTypePhase('octavos', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
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
		$gamesRepechage = null;
		
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
			$gamesRepechage = $this->competitionRepository->getGamesForTypePhase('repechaje', $currentCup->id);
			$gamesCuartos = $this->competitionRepository->getGamesForTypePhase('cuartos', $currentCup->id);
			$gamesSemiFinal = $this->competitionRepository->getGamesForTypePhase('semifinal', $currentCup->id);
			$gamesFinal = $this->competitionRepository->getGamesForTypePhase('final', $currentCup->id);
		}
	 	return View::make('public.mundial_clubes.mundial_clubes', compact(
	 													'mundialClubesCups',
	 													'currentCup',
	 													'gamesForPhases',
	 													'tablePosTeams',
	 													'gamesForGroups',
	 													'winner',
	 													'gamesRepechage',
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
