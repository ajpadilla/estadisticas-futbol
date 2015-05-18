<?php

use soccer\Competition\CompetitionRepository;
use soccer\Competition\CompetitionFormat\CompetitionFormatRepository;
use soccer\Forms\RegisterCompetition;
use soccer\Forms\RegisterGroupForm;
use soccer\Group\GroupRepository;
use soccer\Game\GameType\GameTypeRepository;
use Laracasts\Validation\FormValidationException;

class CompetitionController extends \BaseController {

	protected $repository;
	protected $competitionFormatRepository;
	protected $registerCompetition;
	protected $registerGroupForm;
	protected $groupRepository;
	protected $gameTypeRepository;

	public function __construct(CompetitionRepository $repository,
			CompetitionFormatRepository $competitionFormatRepository,
			RegisterCompetition $registerCompetition,
			RegisterGroupForm $registerGroupForm,
			GroupRepository $groupRepository,
			GameTypeRepository $gameTypeRepository
		){
		$this->repository = $repository;
		$this->competitionFormatRepository = $competitionFormatRepository;
		$this->registerCompetition = $registerCompetition;
		$this->groupRepository = $groupRepository;
		$this->gameTypeRepository = $gameTypeRepository;
		$this->registerGroupForm = $registerGroupForm;
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
		$gameTypes = $this->gameTypeRepository->getAll();
		$tables = $this->repository->getGroupTables($id);
		$currentPhase = $this->repository->getCurrentPhase($id);
		$formats = $this->competitionFormatRepository->getAll();
		//dd($tables);
		//$tableTemplate = 'groups.partials._table-template';
		$scriptTableTemplate = 'groups.partials._script-table-template';
		return View::make('competitions.show', compact('competition', 'tables', 'tableTemplate', 'scriptTableTemplate', 'gameTypes', 'currentPhase', 'formats'));
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
	

	public function addGroupApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerGroupForm->validate($input);
				$group = $this->groupRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('group', $group);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('data', $input);
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}

	public function getAvailableTeams($id)
	{
		if(Request::ajax())
		{
			$teams = $this->repository->getAvailableTeams($id);
			$this->setSuccess(($teams ? true : false));
			$this->addToResponseArray('data', $input);
			if($teams)
				$this->addToResponseArray('teams', $teams);
		}else{
			$this->setSuccess(false);
		}
		return $this->getResponseArrayJson();
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