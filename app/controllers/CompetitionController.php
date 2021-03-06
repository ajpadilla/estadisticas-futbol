<?php

use soccer\Competition\CompetitionRepository;
use soccer\TipoCompetencia\TipoCompetenciaRepository;
use soccer\Pais\PaisRepository;
use soccer\Competition\CompetitionFormat\CompetitionFormatRepository;
use soccer\Forms\EditCompetitionForm;
use soccer\Forms\RegisterCompetition;
use soccer\Forms\RegisterGroupForm;
use soccer\Forms\RegisterPhaseForm;
use soccer\Group\GroupRepository;
use soccer\Game\GameType\GameTypeRepository;
use soccer\Competition\Phase\PhaseRepository;
use Laracasts\Validation\FormValidationException;

class CompetitionController extends \BaseController {

	protected $repository;
	protected $competitionFormatRepository;
	protected $registerCompetition;
	protected $registerGroupForm;
	protected $groupRepository;
	protected $gameTypeRepository;
	protected $registerPhaseForm;
	protected $phaseRepository;
	protected $countryRepository;
	protected $editCompetitionForm;

	public function __construct(CompetitionRepository $repository,
			CompetitionFormatRepository $competitionFormatRepository,
			RegisterCompetition $registerCompetition,
			RegisterGroupForm $registerGroupForm,
			RegisterPhaseForm $registerPhaseForm,
			GroupRepository $groupRepository,
			GameTypeRepository $gameTypeRepository,
			PhaseRepository $phaseRepository,
			PaisRepository $countryRepository,
			EditCompetitionForm $editCompetitionForm
		){
		$this->repository = $repository;
		$this->competitionFormatRepository = $competitionFormatRepository;
		$this->registerCompetition = $registerCompetition;
		$this->groupRepository = $groupRepository;
		$this->gameTypeRepository = $gameTypeRepository;
		$this->registerGroupForm = $registerGroupForm;
		$this->registerPhaseForm = $registerPhaseForm;
		$this->phaseRepository = $phaseRepository;
		$this->countryRepository = $countryRepository;
		$this->editCompetitionForm = $editCompetitionForm;
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
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
			}
		}
		return $this->getResponseArrayJson();
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
		$countries = $this->countryRepository->getAllForSelect();
		$gameTypes = $this->gameTypeRepository->getAll();
		$tables = $this->repository->getGroupTables($id);
		$gamesTables = $this->repository->getGamesTables($id);
		$currentPhase = $this->repository->getCurrentPhase($id);
		$formats = $this->competitionFormatRepository->getAll();
		$winner = $this->repository->winner($id);
		$teamsTable = $this->repository->getTeamsForPromotionsTable($id);
		$tableTemplate = 'groups.partials._table-template';
		$scriptTableTemplate = 'partials._script-table-template';
		return View::make('competitions.show', compact('competition', 'winner', 'countries', 'tables', 'gamesTables', 'tableTemplate', 'scriptTableTemplate', 'gameTypes', 'currentPhase', 'formats', 
			'teamsTable'));
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
		$input = Input::all();
		$input['competition_id'] = $id;
		try
		{
			$this->editCompetitionForm->validate($input);
			$competition = $this->repository->update($input);
			return Redirect::route('competitions.show', $id);
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
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

	public function listPromotionsApi($id)
	{
		return $this->repository->getDefaultTableForPromotionTeams($id);
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

	public function addPhaseApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerPhaseForm->validate($input);
				$phase = $this->phaseRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('phase', $phase->toArray());
				$this->addToResponseArray('data', $input);
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
			}
		}
		return $this->getResponseArrayJson();
	}

	public function getAllCompetitios()
	{
		if(Request::ajax())
		{
			$competitions = $this->repository->getAll();
			$this->setSuccess(true);
			$this->addToResponseArray('competitions', $competitions);
		}
		return $this->getResponseArrayJson();
	}

	public function getTeamsForPromotions()
	{
		if (Request::ajax()) 
		{
			$teams = $this->repository->getAvailableTeamsPromotions(Input::get('competitionId'));
			$this->setSuccess(($teams ? true : false));
			$this->addToResponseArray('teams', $teams);
			$this->addToResponseArray('data', Input::all());
		}
		return $this->getResponseArrayJson();
	}

	public function addTeamsFormPromotions()
	{
		if (Request::ajax()) 
		{
			$competition = $this->repository->addPromotions(Input::all());
			$this->setSuccess(($competition ? true : false));
			$this->addToResponseArray('competition', $competition);
			$this->addToResponseArray('data', Input::all());
		}
		return $this->getResponseArrayJson();
	}

}