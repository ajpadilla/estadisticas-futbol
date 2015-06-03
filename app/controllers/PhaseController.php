<?php

use soccer\Competition\Phase\PhaseRepository;
use soccer\Group\GroupRepository;
use soccer\Forms\RegisterGroupForm;
use soccer\Forms\RegisterPhaseForm;
use soccer\Forms\EditPhaseForm;
use soccer\Game\GameType\GameTypeRepository;
use Laracasts\Validation\FormValidationException;

class PhaseController extends \BaseController {

	protected $repository;
	protected $registerCompetition;
	protected $registerGroupForm;
	protected $groupRepository;
	protected $gameTypeRepository;
	protected $registerPhaseForm;
	protected $editPhaseForm;

	public function __construct(PhaseRepository $repository,
			GroupRepository $groupRepository,
			RegisterGroupForm $registerGroupForm,
			RegisterPhaseForm $registerPhaseForm,
			EditPhaseForm $editPhaseForm
		){
		$this->repository = $repository;
		$this->groupRepository = $groupRepository;
		$this->registerGroupForm = $registerGroupForm;
		$this->registerPhaseForm = $registerPhaseForm;
		$this->editPhaseForm = $editPhaseForm;;
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
		//dd($tables);
		//$tableTemplate = 'groups.partials._table-template';
		$scriptTableTemplate = 'groups.partials._script-table-template';
		return View::make('competitions.show', compact('competition', 'tables', 'tableTemplate', 'scriptTableTemplate', 'gameTypes'));
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

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('phaseId')));
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
				$this->setSuccess(($group ? true : false));
				$this->addToResponseArray('data', ($group ? $group : $input));				
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('data', $input);
				$this->addToResponseArray('errors', $e->getErrors()->all());
			}
			return $this->getResponseArrayJson();

		}
	}

	public function getAvailableTeams($id)
	{
		if(Request::ajax())
		{
			//$teams = [];
			$teams = $this->repository->getAvailableTeamsForGroup($id);
			$this->setSuccess(true);
			$this->addToResponseArray('data', ($teams ? $teams : array()));
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

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('phaseId'))
			{
				$phase = $this->repository->get(Input::get('phaseId'));
				$this->setSuccess(($phase ? true : false));
				$this->addToResponseArray('phase', $phase);
				$this->addToResponseArray('from', date_format($phase->from, 'Y-m-d'));
				$this->addToResponseArray('to', date_format($phase->to, 'Y-m-d'));
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
	}

	public function updateApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editPhaseForm->validate($input);
				$phase = $this->repository->get($input['phase_id']);
				$phase->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('phase', $phase);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}

}