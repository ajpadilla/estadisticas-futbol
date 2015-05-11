<?php

use soccer\Group\GroupRepository;

class GroupController extends \BaseController {

	protected $repository;

	public function __construct(GroupRepository $repository){
		$this->repository = $repository;
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
	public function addTeamApi($id, $teamId)
	{
		
	}	

	public function addGameApi()
	{
		
	}

	public function listGroupApi($id)
	{
		return $this->repository->getDefaultTableForGroupTeams($id);
	}

	public function getAllTeamsForCompetitions()
	{
		if(Request::ajax())
		{
			$teams = $this->repository->getAvailableTeams(Input::get('competitionId'));
			$this->setSuccess(true);
			$this->addToResponseArray('teams', $teams);
			return $this->getResponseArrayJson();
		}else{
			$this->setSuccess(false);
			return $this->getResponseArrayJson();
		}
	}

}