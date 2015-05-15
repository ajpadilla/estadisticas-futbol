<?php

use soccer\Group\GroupRepository;
use soccer\Competition\CompetitionRepository;
use soccer\Forms\RegisterTeamGroupForm;
use Laracasts\Validation\FormValidationException;

class GroupController extends \BaseController {

	protected $repository;
	protected $competitionRepository;
	protected $registerTeamGroupForm;

	public function __construct(
			GroupRepository $repository,
			CompetitionRepository $competitionRepository,
			RegisterTeamGroupForm $registerTeamGroupForm
		){
		$this->repository = $repository;
		$this->competitionRepository = $competitionRepository;
		$this->registerTeamGroupForm = $registerTeamGroupForm;
	}	


	/**
	 * Display a listing of the resource.
	 * GET /group.php
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /group.php/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /group.php
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /group.php/{id}
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
	 * GET /group.php/{id}/edit
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
	 * PUT /group.php/{id}
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
	 * DELETE /group.php/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/*
	****************** API ******************
	*/
	public function addTeamApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$idGroup = (int)$input['group_id'];
				$teams = $input['teams_ids'];
				$this->registerTeamGroupForm->validate($input);
				$group = $this->repository->addTeams($idGroup, $teams);
				$this->setSuccess(($group ? true : false));
				$this->addToResponseArray('data', $input);
				$this->addToResponseArray('group', $group);
				return $this->getResponseArrayJson();			
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('data', $input);
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}	

	public function addGameApi()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();		
			$id = $input['group_id'];
			$game = $this->repository->addGame($id, $input);
			$this->setSuccess(($game ? true : false));
			$this->addToResponseArray('game', $game);
		}else{
			$this->setSuccess(false);
		}		
		return $this->getResponseArrayJson();
	}

	public function existGameApi($id, $localTeam, $awayTeam)
	{
		if(Request::ajax()) 
			$this->setSuccess( (bool) $this->repository->gameAlreadyExists($id, $localTeam, $awayTeam));
		return $this->getResponseArrayJson();
	}	

	public function listGroupApi($id)
	{
		return $this->repository->getDefaultTableForGroupTeams($id);
	}
}