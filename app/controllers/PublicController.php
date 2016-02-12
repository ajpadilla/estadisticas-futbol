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

	public function gamesForWorldCup()
	{
		$cups = $this->competitionRepository
		->getModel()
		->whereType('copa mundial')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.mundial._mundial', compact('cups','competitionRepository'));
	}

	public function gamesForAmericaCup()
	{
		$americaCups = $this->competitionRepository
		->getModel()
		->whereType('copa america')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.copa_america._copa_america', compact('americaCups','competitionRepository'));
	}

	public function gamesForLibertadoresCup()
	{
		$libertadoresCups = $this->competitionRepository
		->getModel()
		->whereType('copa libertadores')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.libertadores._libertadores', compact('libertadoresCups','competitionRepository'));
	}

	public function gamesForChampionsCup()
	{
		$championsCups = $this->competitionRepository
		->getModel()
		->whereType('champion L')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.champions._champions', compact('championsCups','competitionRepository'));
	}

	public function gamesForArgentinaCup()
	{
		$argentinaCups = $this->competitionRepository
		->getModel()
		->whereType('copa argentina')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.copa_argentina._copa_argentina', compact('argentinaCups','competitionRepository'));
	}

	public function gamesForSudamericanaCup()
	{
		$sudamericanaCups = $this->competitionRepository
		->getModel()
		->whereType('sudamericana')
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc')
		->paginate(1);
		$competitionRepository =  $this->competitionRepository;
	 	return View::make('public.sudamericana._sudamericana', compact('sudamericanaCups','competitionRepository'));
	}

	public function getCompetitionsForCurrentAverage()
	{
		if (Request::ajax())
		{
			$competition = $this->competitionRepository->get(Input::get('competitionId'));

			$competitions = $this->competitionRepository
			->getModel()
			->whereType($competition->type)
			->orderBy('desde', 'desc')
			->orderBy('hasta', 'desc') 
			->where('desde','<=', $competition->desde)
			->where('hasta','<=', $competition->hasta)
			->take(6)
			->get();

			if(count($competitions) > 0)
				$averages = $this->competitionRepository->getAverage($competitions, $competition);

			$this->setSuccess(($averages ? true : false));
			$this->addToResponseArray('averages', $averages);
			return $this->getResponseArrayJson();
		}
	}

}
