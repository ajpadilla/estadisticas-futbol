<?php

use soccer\Game\GameRepository;
use soccer\Game\Goal\GoalRepository;
use soccer\Game\Sanction\SanctionRepository;
use soccer\Game\Change\ChangeRepository;
use soccer\Forms\RegisterGameForm;
use soccer\Forms\RegisterGoalForm;
use soccer\Forms\RegisterSanctionForm;
use soccer\Forms\RegisterChangeForm;
use soccer\Forms\AvailablePlayersForTeamForm;
use Laracasts\Validation\FormValidationException;

class GameController extends \BaseController {

	protected $repository;
	protected $registerGameForm;
	protected $availablePlayersForTeamForm;
	protected $goalRepository;
	protected $registerGoalForm;
	protected $registerSanctionForm;
	protected $sanctionRepository;
	protected $registerChangeForm;
	protected $changeRepository;

	public function __construct(GameRepository $repository,
			RegisterGameForm $registerGameForm,
			AvailablePlayersForTeamForm $availablePlayersForTeamForm,
			GoalRepository $goalRepository,
			RegisterGoalForm $registerGoalForm,
			RegisterSanctionForm $registerSanctionForm,
			SanctionRepository $sanctionRepository,
			RegisterChangeForm $registerChangeForm,
			ChangeRepository $changeRepository){

		$this->repository = $repository;
		$this->registerGameForm = $registerGameForm;
		$this->availablePlayersForTeamForm = $availablePlayersForTeamForm;
		$this->goalRepository = $goalRepository;
		$this->registerGoalForm = $registerGoalForm;
		$this->registerSanctionForm = $registerSanctionForm;
		$this->sanctionRepository = $sanctionRepository;
		$this->registerChangeForm = $registerChangeForm;
		$this->changeRepository = $changeRepository;
	}

	/**
	 * Display a listing of the resource.
	 * GET /game
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /game/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /game
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Response::ajax()) {
			$input = Input::all();
			try
			{
				$this->registerGameForm->validate($input);
				$game = $this->repository->create($input);
				if($game) {
					$this->setSuccess(true);
					$this->addToResponseArray('game', $game);
				}
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}			
		}
	}

	/**
	 * Display the specified resource.
	 * GET /game/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$game = $this->repository->get($id);
		$goalsTable = $this->repository->getGoalsTable($game->id);
		$sanctionsTable = $this->repository->getSanctionsTable($game->id);
		$changesTable = $this->repository->getChangesTable($game->id);
		$scriptTableTemplate = 'partials._script-table-template';
		return View::make('games.show', compact('game', 'goalsTable', 'changesTable', 'sanctionsTable', 'scriptTableTemplate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /game/{id}/edit
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
	 * PUT /game/{id}
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
	 * DELETE /game/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/*
	************************** API METHODS *****************************
	*/	

	public function getAvailableTeams($id)
	{
		if (Request::ajax()) 
		{
			$teams = $this->repository->availableTeams($id);
			if (count($teams) > 0) {
				$this->setSuccess(true);
				$this->addToResponseArray('teams', $teams);
			}
		}
		return $this->getResponseArrayJson();
	}

	public function getAvailablePlayersForTeam($id, $teamId)
	{
		if (Request::ajax()) 
		{
			/*$this->addToResponseArray('players', []);
			return $this->getResponseArrayJson();*/

			$input = [];
			$input['id'] = $id;
			$input['teamId'] = $teamId;
			try
			{
				$this->availablePlayersForTeamForm->validate($input);
				$players = $this->repository->availablePlayersForGameTeam($id, $teamId);
				if(count($players) > 0) {
					$this->setSuccess(true);
					$this->addToResponseArray('players', $players);
					return $this->getResponseArrayJson();
				}
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
			}
		}
		return $this->getResponseArrayJson();
	}

	
	public function addGoalApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerGoalForm->validate($input);
				$goal = $this->goalRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('goal', $goal);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();				
			}
		}
	}

	public function addSantionApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerSanctionForm->validate($input);
				$sanction = $this->sanctionRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('sanction', $sanction);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();				
			}
		}
	}

	public function addChangeApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerChangeForm->validate($input);
				$change = $this->changeRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('change', $change);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();				
			}
		}
	}

	public function goalsApi($id)
	{
		if(Request::ajax()) 
			return $this->repository->getDefaultTableForGoals($id);
	}

	public function changesApi($id)
	{
		if(Request::ajax()) 
			return $this->repository->getDefaultTableForChanges($id);
	}

	public function sanctionsApi($id)
	{
		if(Request::ajax()) 
			return $this->repository->getDefaultTableForSanctions($id);
	}
}