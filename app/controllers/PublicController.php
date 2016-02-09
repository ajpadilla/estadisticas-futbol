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
		$showToday = false;
		$view = null;
		$date = null;

		$tomorrow = Carbon::tomorrow()->formatLocalized('%Y-%m-%d');
		$today = ucwords (Carbon::today()->formatLocalized('%A %d %B %Y'));
		$yesterday = Carbon::yesterday()->formatLocalized('%Y-%m-%d');

		$competitions = $this->competitionRepository->getAll();

	 	switch ($day) {
	 		case "tomorrow":
	 			$showTomorrow = true;
	 			$date = Carbon::tomorrow();
	 			$today = ucwords (Carbon::tomorrow()->formatLocalized('%A %d %B %Y'));
	 			$view = View::make('public.home', compact('competitions','date','today','showTomorrow','showYesterday'));
	 			break;
	 		case "yesterday":
	 			$showYesterday = true;
	 			$date = Carbon::yesterday();
	 			$today = ucwords (Carbon::yesterday()->formatLocalized('%A %d %B %Y'));
	 			$view = View::make('public.home', compact('competitions','date','today','showTomorrow','showYesterday'));
	 			break;
	 		case "today":
	 			$showToday = true;
	 			$view = View::make('public.home', compact('competitions','today','showToday'));
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
		->orderBy('hasta', 'desc')
		->paginate(1);
	 	return View::make('public.primera._primera', compact('competitions'));
	}

	public function positionsteamsForCompetitions()
	{
		$groupsFixtures = $this->competitionRepository->positionsTeamsForTournament(Input::get('id'));
		$this->setSuccess(true);
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

}
