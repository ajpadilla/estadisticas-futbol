<?php

use soccer\Competition\CompetitionRepository;
use soccer\Forms\RegisterCompetition;
use soccer\Group\GroupRepository;
use Laracasts\Validation\FormValidationException;

class CompetitionController extends \BaseController {

	protected $repository;
	protected $registerCompetition;
	protected $groupRepository;

	public function __construct(CompetitionRepository $repository,
			RegisterCompetition $registerCompetition,
			GroupRepository $groupRepository
		){
		$this->repository = $repository;
		$this->registerCompetition = $registerCompetition;
		$this->groupRepository = $groupRepository;
	}

	/**
	 * Display a listing of the resource.
	 * GET /Competition
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('competitions.index', compact('table'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /Competition/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /Competition
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerCompetition->validate($input);
				$competition = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('competencia', $competition->toArray());
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();				
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /competencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$competition = $this->repository->get($id);
		$tables = $this->repository->getGroupTables($id);
		//$tableTemplate = 'groups.partials._table-template';
		$scriptTableTemplate = 'groups.partials._script-table-template';
		return View::make('competitions.show', compact('competition', 'tables', 'tableTemplate', 'scriptTableTemplate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /competencia/{id}/edit
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
	 * PUT /Competition/{id}
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
	 * DELETE /Competition/{id}
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
	public function updateApi($id)
	{
		# code...
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('competitionId')));
		return $this->getResponseArrayJson();
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}
	

	public function addGroupApi($id)
	{
		$input = Input::all();
		$input['competition_id'] = $id;
		$this->groupRepository->create($input);
		return Redirect::route('competencias.show', $id);
	}

	public function getAllValue()
	{
		if(Request::ajax())
		{
			$competitions = $this->repository->getAllForSelect();
			if (count($competitions) > 0) {
				$this->setSuccess(true);
				$this->addToResponseArray('data', $competitions);
			}
		}
		return $this->getResponseArrayJson();
	}


}